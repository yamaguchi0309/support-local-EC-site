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
        <div class="block" style="flex-wrap: wrap; justify-content: flex-start; column-gap: 5%; margin: 0 50px;">

        @php $total_amount = '0'; @endphp
              @foreach($order_detail_data as $order_detail)
                    @php $item_price = $order_detail->price * $order_detail->tax; @endphp
                        @csrf
                    <div class="item_info" style="display: flex; width:100%; margin:5px 20px;">
                        <div class=item_pic><img src="{{asset('img/items/'.$order_detail->item_img)}}" style="height:100px;"></div>
                        <div class="item_detail">
                            <p style="text-align: right;">{{$order_detail->name}}</p>
                            <p style="text-align: right;">{{number_format($item_price)}}円</p>
                        </div>
                            <p style="text-align: right;">{{$order_detail->quantity}}個</p>
                            <p style="text-align: right;">{{number_format($order_detail->amount)}}円</p>
                    </div>
              @endforeach

              @foreach($order_data as $order)
                <p>小計：{{number_format($order->amount)}}円</p>
                <p>送料：{{number_format($order->postage)}}円</p>
                  @php $total_amount = $order->amount + $order->postage; @endphp
                <p>合計：{{number_format($total_amount)}}円</p>
              @endforeach


        <table class="admin_table">
        <tr><th>orderID</th><th>userID</th><th>注文番号</th><th>注文日</th><th>お支払い金額</th><th>お支払い方法</th><th>お支払い状況</th><th>注文状況<br>(1:受領済、2:取消済)</th><th>配送状況<br>(1:配送済、2:配達済)</th><th>更新日</th></tr>
          @foreach($order_data as $order)
            
            <!-- お支払い金額（金額＋送料） -->
            @php  $total_amount = $order->amount + $order->postage; @endphp

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
                       
            <tr>
            <td style="width:50px;">{{$order->id}}</td>
            <td style="width:50px;">{{$order->user_id}}</td>
            <td>{{$order->order_num}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{number_format($total_amount)}}円</td>
            <td>{{$Payment_method}}</td>
            <td style="width:50px;">{{$Payment_status}}</td>
            <td style="width:50px;">{{$Order_status}}</td>
            <td style="width:50px;">{{$Shipping_status}}</td>
            <td>{{$order->updated_at}}</td></tr></table>  									

              <div class="block" style="display: block; width:100%">
              
                <p>配送先電話番号</p>
                <p>{{$order->shipping_tel}}</p>
                <p>配送先郵便番号</p>
                <p>{{$order->shipping_postcode}}</p>
                <p>配送先住所</p>
                <p>{{$order->shipping_address}}</p>
                <p>メモ</p>
                <p>{{$order->memo}}</p>
                
                <div class="confirm_btn">
                    <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                    <button class="next_btn" onclick="location.href='{{ route('admin.orders.edit', ['id'=>$order->id]) }}'">編集</button>
                </div>
              @endforeach
              </div>
        </div>
    </div>
  </body>
</html>
