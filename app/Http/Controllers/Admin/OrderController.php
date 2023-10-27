<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class OrderController extends Controller
{
    public function selectOrderData()
    {
        $order_data = DB::table('orders')->simplePaginate(10);
        return view('admin.orders', compact('order_data'));
    }

    public function findOrderData(Request $request, $id) 
    {   
        $order_data = DB::select(
            "SELECT * 
            FROM  orders
            WHERE id = '$id'"
        ); 

        $order_detail_data = DB::select(
            "SELECT OI.id, OI.order_id, OI.item_id, I.name, I.price, I.tax, I.item_img, FLOOR(I.price * I.tax * OI.quantity) as amount, OI.quantity
            FROM  orders_items OI
            JOIN  Items I ON OI.item_id = I.id
            WHERE OI.order_id = '$id'"
        ); 

        return view('admin.orders.detail', compact('order_data','order_detail_data'));
    }
    public function edit_findOrderData(Request $request,$id) 
    {   
        $order_data = DB::select(
            "SELECT * 
            FROM  orders
            WHERE id = '$id'"
        ); 

        $order_detail_data = DB::select(
            "SELECT OI.id, OI.order_id, OI.item_id, I.name, I.price, I.tax, I.item_img, FLOOR(I.price * I.tax * OI.quantity) as amount, OI.quantity
            FROM  orders_items OI
            JOIN  Items I ON OI.item_id = I.id
            WHERE OI.order_id = '$id'"
        ); 

        return view('admin.orders.edit', compact('order_data','order_detail_data'));
    }

    public function update(Request $request) 
    { 
        DB::table('orders_items')->where('order_id','=',$request->id)->where('item_id','=',$request->Iid)->update([
            'quantity' => $request->Quantity,
            ]);

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

        return view('admin.orders.edit', compact('order_data','order_detail_data'));
    }

    public function edit_update(Request $request) 
    { 
        $shipping_data = $request->post();
        $shipping_data = $request->validate([
            'Order_status' => 'required|regex:/^[0-2]+$/',
            'Shipping_status' => 'required|regex:/^[0-2]+$/',
            'Tel' => 'required|regex:/^0[0-9]{10,11}$/',
            'Postcode' => 'required|digits:7',
            'Address' => 'required',
            'Memo' => 'required',
       ],
       [
            'Order_status.required' => '注文状況は必須項目です。',
            'Order_status.regex' => '適切なステータス番号を入力してください。',
            'Shipping_status.required' => '配送状況は必須項目です。',
            'Shipping_status.regex' => '適切なステータス番号を入力してください。',
            'Tel.required' => '電話番号は必須項目です。',
            'Tel.regex' => '数字のみで、正しい電話番号を入力してください。',
            'Postcode.required' => '郵便番号は必須項目です。',
            'Postcode.digits' => '数字のみで、正しい郵便番号を入力してください。',
            'Address.required' => '住所は必須項目です。',
            'Memo.required' => '更新した場合は経緯を記載してください。',
        ]);

        DB::table('orders')->where('id','=',$request->id)->update([
            'order_status' => $request->Order_status,
            'shipping_status' => $request->Shipping_status,
            'shipping_tel' => $request->Tel,
            'shipping_postcode' => $request->Postcode,
            'shipping_address' => $request->Address,
            'memo' => $request->Memo,
            ]);

        return view('admin.orders.edit_complete');
    }


}