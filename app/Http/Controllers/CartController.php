<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }

    public function index() 
    {
        $user_id = Auth::user()->id;
        $cart_data = DB::select(
            "SELECT C.id, C.user_id, C.item_id, I.name, I.price, I.tax, I.item_img, FLOOR(I.price * I.tax * C.quantity) as amount, C.quantity
            FROM  carts C
            JOIN  Items I ON C.item_id = I.id
            WHERE C.user_id = '$user_id' AND C.quantity > '0'"
        ); 

        return view('cart', compact('cart_data'));
    }

    public function insertCart(Request $request) 
    {    
        // $item_data = DB::select("SELECT id, name, description, price, tax, stock, is_selling, item_img, memo FROM items WHERE id = '$request->Iid'"); 
        $user_id = Auth::user()->id;
        
        $cart = DB::select(
            "SELECT C.id, C.user_id, C.item_id, C.quantity
             FROM  carts C
             JOIN  Items I ON C.item_id = I.id
             WHERE  C.user_id = '$user_id' AND C.item_id = '$request->Iid'"
        ); 

        if(empty($cart)){        
            DB::table('carts')->insert([
                'user_id' => $user_id,
                'item_id' => $request->Iid,
                'quantity' => '1',
            ]);

        }else{
            DB::table('carts')->where('user_id','=',$user_id)->where('item_id','=',$request->Iid)->increment('quantity');
        }

        $return_view  = $this->index();
        return $return_view;
    }

    public function updateQuantity(Request $request) 
    { 
        $user_id = Auth::user()->id;
        DB::table('carts')->where('user_id','=',$user_id)->where('item_id','=',$request->Iid)->update([
            'quantity' => $request->Quantity,
            ]);

        $return_view  = $this->index();
        return $return_view;
    }

    public function order_confirm(Request $request) 
    {
        $user_id = Auth::user()->id;
        $cart_data = DB::select(
            "SELECT C.id, C.user_id, C.item_id, I.name, I.price, I.tax, I.item_img, FLOOR(I.price * I.tax * C.quantity) as amount, C.quantity
            FROM  carts C
            JOIN  Items I ON C.item_id = I.id
            WHERE C.user_id = '$user_id' AND C.quantity > '0'"
        ); 

        $shipping_data = $request->post();
        $shipping_data = $request->validate([
            'Tel' => 'required|regex:/^0[0-9]{10,11}$/',
            'Postcode' => 'required|digits:7',
            'Address' => 'required',
       ],
       [
            'Tel.required' => '電話番号は必須項目です。',
            'Tel.regex' => '数字のみで、正しい電話番号を入力してください。',
            'Postcode.required' => '郵便番号は必須項目です。',
            'Postcode.digits' => '数字のみで、正しい郵便番号を入力してください。',
            'Address.required' => '住所は必須項目です。',
        ]);

        return view('order.confirm', compact('cart_data','shipping_data'));
    }

    public function insertOrder(Request $request) 
    {    
        $user_id = Auth::user()->id;

        //注文番号作成
        $date = date('ymd');    // 今日の日付を数値化して格納
        $alpbt = str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ");   // アルファベットを配列に格納
        $num = mt_rand(1000,9999);  // 4桁の数字をランダムで格納
        $rand_keys = array_rand($alpbt, 1); // $alpbt配列からランダムで1つ格納
        $order_num = $date.$alpbt[$rand_keys].$num; // 日付、アルファベット、数字を連結

        // ordersテーブルに注文情報を作成
        DB::table('orders')->insert([
            'user_id' => $user_id,
            'order_num' => $order_num,
            'shipping_tel' => $request->Tel,
            'shipping_postcode' => $request->Postcode,
            'shipping_address' => $request->Address,
            'amount' => $request->Amount,
            'postage' => $request->Postage,
            'shipping_status' => '0',
            'order_status' => '1',
            'payment_status' => '1',
            'payment_method' => '0',
        ]);

        // order_idを取得
        $order_data = DB::select(
            "SELECT id
             FROM orders O1 
             WHERE NOT EXISTS (
                SELECT * 
                FROM orders O2 
                WHERE O1.user_id = O2.user_id 
                AND O1.created_at < O2.created_at)"
        ); 

        // catrsテーブルの情報を取得（該当するuser_id）
        $cart_data = DB::select(
            "SELECT item_id, quantity
            FROM  carts
            WHERE user_id = '$user_id' AND quantity > '0'"
        ); 

        // orders_itemsテーブル（注文詳細テーブル）にcartsテーブルの情報を格納
        foreach($order_data as $order) {
            foreach($cart_data as $cart) {
                DB::table('orders_items')->insert([
                    'order_id' => $order->id,
                    'item_id' => $cart->item_id,
                    'quantity' => $cart->quantity,
                ]);
            }
        }

        DB::table('carts')->where('user_id','=',$user_id)->delete();
        
        return view('order.complete');
    }
}
