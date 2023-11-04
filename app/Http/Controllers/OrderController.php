<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }
    public function selectOrderData()
    {
        $user_id = Auth::user()->id;
        $order_data = Order::where('user_id', $user_id)->paginate(5);

        return view('mypage.orders', compact('order_data'));
    }

    public function findOrderData(Request $request) 
    {   
        $order_data = DB::select(
            "SELECT * 
            FROM  orders
            WHERE id = '$request->id'"
        ); 

        $order_detail_data = DB::select(
            "SELECT OI.id, OI.order_id, OI.item_id, I.name, I.price, I.tax, I.item_img, FLOOR(I.price * I.tax * OI.quantity) as amount, OI.quantity
            FROM  orders_items OI
            JOIN  Items I ON OI.item_id = I.id
            WHERE OI.order_id = '$request->id'"
        ); 

        return view('mypage.orders.detail', compact('order_data','order_detail_data'));
    }

    public function update(Request $request) 
    {    
       DB::table('orders')->where('id','=',$request->id)->update([
                'order_status' => '2',
                'shipping_status' => '3',
            ]);
        return view('mypage.orders.cancel_complete');  
    }

    

}