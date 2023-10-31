<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CafeCafe</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/base.css')}}">
    <!-- asset関数を使うとうまくいくかも、public -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
  </head>
  <body>
    <header class="header">
        @include('header')
    </header>

    <div class="user_main">
      <p class="page_title">注文内容詳細</p>
      <div class="block" style="flex-wrap:wrap; justify-content:flex-start; column-gap:5%; margin:0 50px;">
          @php $total_amount = '0'; @endphp
          @foreach($order_detail_data as $order_detail)
            @php $item_price = $order_detail->price * $order_detail->tax; @endphp
              @csrf
            <div class="item_info" style="display: flex; width:100%; margin:5px 20px;">
                <div class=item_pic><img src="{{asset('img/items/'.$order_detail->item_img)}}" style="margin-right:20px; width:100px; height:100px;"></div>
                <div class="item_detail" style="display:flex; width:100%;">
                  <p style="text-align:left; width:60%;">{{$order_detail->name}}</p>
                  <p style="text-align:right; width:15%;">{{number_format($item_price)}}円</p>
                  <p style="text-align:right; width:5%;">{{$order_detail->quantity}}個</p>
                  <!-- <p style="text-align:right; width:5%;font-weight: bold;">計：</p> -->
                  <p style="text-align:right; width:20%;font-weight: bold;">計：{{number_format($order_detail->amount)}}円</p>
                </div>
            </div>
          @endforeach

          @foreach($order_data as $order)
          <div style="display:block; padding:10px 20px 10px; border-top: 1px solid #666;border-bottom: 1px solid #666;width:100%;">
            <p style="text-align:right; padding:5px 0px; font-weight:bold;">小計：{{number_format($order->amount)}}円</p>
            <p style="text-align:right; padding:5px 0px; font-weight:bold;">送料：&nbsp;&nbsp;{{number_format($order->postage)}}円</p>
              @php $total_amount = $order->amount + $order->postage; @endphp
            <p style="text-align:right; padding:5px 0px; font-weight:bold; float:right; border-top: 1px solid #666; display:inline-block; ">合計：{{number_format($total_amount)}}円</p>
          </div>
          @endforeach

          <table class="admin_table" style="margin:10px 0;">
            <tr style="background:#c3c3c3; border:2px solid #ffffff;"><th>orderID</th><th>userID</th><th>注文番号</th><th>注文日</th><th>お支払い金額</th><th>お支払い方法</th><th>お支払い状況</th><th>注文状況<br>1:受領済<br>2:取消済</th><th>配送状況<br>1:配送済<br>2:配達済</th><th>更新日</th></tr>
            @foreach($order_data as $order)
            
              <!-- お支払い金額（金額＋送料） -->
              @php  $total_amount = $order->amount + $order->postage; @endphp

              <!-- 値→文字変換 -->
              <!-- お支払い方法 -->
              @php
              if($order->payment_method === "0"){
                $Payment_method = "クレジットカード";
              }elseif($order->payment_method === "1"){
                $Payment_method = "銀行振込";
              }
              @endphp

              <!-- お支払い方法 -->
              @php
              if($order->payment_status === "0"){
                $Payment_status = "受付済";
              }elseif($order->payment_status === "1"){
                $Payment_status = "完了";
              }
              @endphp

              <!-- 注文状況 -->
              @php
              if($order->order_status === "0"){
                $Order_status = "ご入金待";
              }elseif($order->order_status === "1"){
                $Order_status = "受領済";
              }elseif($order->order_status === "2"){
                $Order_status = "取消済";
              }
              @endphp
              
              <!-- 配送状況 -->
              @php
              if($order->shipping_status === "0"){
                $Shipping_status = "準備中";
              }elseif($order->shipping_status === "1"){
                $Shipping_status = "発送済";
              }elseif($order->shipping_status === "2"){
                $Shipping_status = "配達済";
              }
              @endphp
                        
              <tr style="border: 2px solid #666;">
              <td style="width:4%;">{{$order->id}}</td>
              <td style="width:4%;">{{$order->user_id}}</td>
              <td style="overflow:scroll; text-overflow:clip; width:11%;">{{$order->order_num}}</td>
              <td style="overflow:scroll; text-overflow:clip; width:15%;">{{$order->created_at}}</td>
              <td>{{number_format($total_amount)}}円</td>
              <td>{{$Payment_method}}</td>
              <td >{{$Payment_status}}</td>
              <td >{{$Order_status}}</td>
              <td >{{$Shipping_status}}</td>
              <td style="overflow:scroll; text-overflow:clip; width:15%;">{{$order->updated_at}}</td></tr></table>  									

              <div class="block" style="display: block; width:100%;">
                <div style="display:flex;  border-bottom: 1px solid #666; margin-top:5px;">
                  <p style="text-align:left;">配送先電話番号</p>
                  <p style="margin:0 0 0 auto;">{{$order->shipping_tel}}</p>
                </div>
                <div style="display:flex; border-bottom: 1px solid #666; margin-top:5px;">
                <p style="text-align:left;">配送先郵便番号</p>
                <p style="margin:0 0 0 auto;">{{$order->shipping_postcode}}</p>
                </div>
                <div style="display:flex; border-bottom: 1px solid #666; margin-top:5px;">
                <p style="text-align:left;">配送先住所</p>
                <p style="text-align:right; width:75%; margin:0 0 0 auto;">{{$order->shipping_address}}</p>
                </div>
                <div style="display:flex; border-bottom: 1px solid #666; margin-top:5px;">
                <p style="text-align:left;">メモ</p>
                <p style="text-align:right; width:75%; margin:0 0 0 auto;">{{$order->memo}}</p>
                </div>
                <div class="confirm_btn">
                  <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                  <button class="next_btn" onclick="location.href='{{ route('admin.orders.edit', ['id'=>$order->id]) }}'">編集</button>
                </div>
              </div>
            @endforeach    
      </div>
    </div>
  </body>
</html>
