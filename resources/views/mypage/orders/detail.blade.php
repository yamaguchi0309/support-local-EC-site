<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NagasakiSasebo</title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
  </head>
  <body>
    <header class="header">
        @include('header')
    </header>

    <div class="user_main">
        <p class="page_title">ご注文内容確認</p>
        <div class="block" style="flex-wrap: wrap; justify-content: flex-start; column-gap: 5%; margin: 0 50px;">  
                
              @php $total_amount = '0'; @endphp
              @foreach($order_detail_data as $order_detail)
                @php $item_price = $order_detail->price * $order_detail->tax; @endphp
                @csrf 
                <div class="item_info" style="align-items: stretch; display: flex; width:100%;margin:0px 0px; padding:10px; border-radius:10px; background:#ff000024;">
                  <div class="user_order_detail_item_pic"><img src="{{asset('img/items/'.$order_detail->item_img)}}" style=""></div>
                  <div class="user_order_detail_item_detail" style="display:block; width:100%;">
                    <div style="display:flex; ">
                    <p style="text-align:left; width:40%; ">{{$order_detail->name}}</p>
                    <p style="width:20%;">{{number_format($item_price)}}円</p>
                    <p style="width:15%;">{{$order_detail->quantity}}個</p>
                    <p style="width:30%;font-weight:bold;">計：{{number_format($order_detail->amount)}}円</p>  
                    </div>
                    
                    @php $total_amount += $order_detail->amount; @endphp
                  </div>
                </div>
              @endforeach

              
              @foreach($order_data as $order)
                <div style="display:block; margin-top:5px; padding:10px; border-top: 1px solid #666;border-bottom: 1px solid #666; width:100%;">
                  <p style="text-align:right; padding:5px 0px; font-weight:bold;">小計：{{number_format($order->amount)}}円</p>
                  <p style="text-align:right; padding:5px 0px; font-weight:bold;">送料：&nbsp;&nbsp;{{number_format($order->postage)}}円</p>
                  @php $total_amount = $order->amount + $order->postage; @endphp
                  <p style="text-align:right; padding:5px 0px; font-weight:bold; float:right; border-top: 1px solid #666; display:inline-block; ">合計：{{number_format($total_amount)}}円</p>
                </div>

                <div class="block" style="display:block; width:100%;padding:10px;">
                  <div class="user_order_detail_tel" style="">
                    <p style="text-align:left;">配送先電話番号</p>
                    <p style="margin:0 0 0 auto;">{{$order->shipping_tel}}</p>
                  </div>
                  <div class="user_order_detail_postcode" style="">
                    <p style="text-align:left;">配送先郵便番号</p>
                    <p style="margin:0 0 0 auto;">{{$order->shipping_postcode}}</p>
                  </div>
                  <div class="user_order_detail_address" style="">
                    <p style="text-align:left;">配送先住所</p>
                    <p style="margin:0 0 0 auto;">{{$order->shipping_address}}</p>
                  </div>

                  <div class="block" style="margin:10px 0; padding:3px; background:black;overflow-x: scroll;">

                  <table class="user_table">
                    <tr><th>注文番号</th><th>注文日</th><th>お支払い方法</th><th>お支払い状況</th><th>注文状況</th><th>配送状況</th></tr>
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
                      if($order->order_status === "2"){
                        $Shipping_status = "注文取消";
                      }elseif($order->shipping_status === "0"){
                        $Shipping_status = "準備中";
                      }elseif($order->shipping_status === "1"){
                        $Shipping_status = "発送済";
                      }elseif($order->shipping_status === "2"){
                        $Shipping_status = "配達済";
                      }
                      @endphp
                       
                      <tr>
                      <td>{{$order->order_num}}</td>
                      <td style="width:16%;">{{$order->created_at}}</td>
                      <td style="width:16%;">{{$Payment_method}}</td>
                      <td style="width:8%;">{{$Payment_status}}</td>
                      <td style="width:8%;">{{$Order_status}}</td>
                      <td style="width:8%;">{{$Shipping_status}}</td></tr></table>    						
                      </div>
                  

                  @if($order->order_status === "2")
                  <div class="confirm_btn">
                      <button class="back_btn" type="button" onclick="history.back(-1)" style="width:50%; margin:0 auto;">戻る</button>
                  </div>
                  @else
                  <form action="{{ url('/mypage/orders/cancel_complete') }}" method="POST">
                  @csrf 
                  <input type="hidden" name="id" value="{{$order->id}}">
                  <div class="form_bl" style="margin-top:15px;">
                    <a>ご注文を取り消される場合は【取消】ボタンを押してください。</a>
                  </div>
                  <div class="confirm_btn">
                      <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                      <button class="submit" type="submit" onclick='return confirm("取消しますか")'>取消</button>
                  </div></form>
                  @endif
                @endforeach
                </div>
        </div>
    </div>

    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>
