<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CafeCafe</title>
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
                <div class="item_info" style="align-items: stretch; display: flex; width:100%; margin:5px 20px">
                  <div class=item_pic><img src="{{asset('img/items/'.$order_detail->item_img)}}" style="margin-right:20px; width:100px; height:100px;"></div>
                  <div class="item_detail" style="display:flex; width:100%;">
                    <p style="text-align:left; width:60%; margin-top:11px;">{{$order_detail->name}}</p>
                    <p style="text-align:right; width:10%; margin-top:11px;">{{number_format($item_price)}}円</p>
                    <p style="text-align:right; width:10%; margin-top:11px;">{{$order_detail->quantity}}個</p>
                    <p style="text-align:right; width:25%; font-weight:bold;  margin-top:11px;">計：{{number_format($order_detail->amount)}}円</p>
                    @php $total_amount += $order_detail->amount; @endphp
                  </div>
                </div>
              @endforeach

              
              @foreach($order_data as $order)
                <div style="display:block; padding:10px 20px 10px; border-top: 1px solid #666;border-bottom: 1px solid #666; width:100%;">
                  <p style="text-align:right; padding:5px 0px; font-weight:bold;">小計：{{number_format($order->amount)}}円</p>
                  <p style="text-align:right; padding:5px 0px; font-weight:bold;">送料：&nbsp;&nbsp;{{number_format($order->postage)}}円</p>
                  @php $total_amount = $order->amount + $order->postage; @endphp
                  <p style="text-align:right; padding:5px 0px; font-weight:bold; float:right; border-top: 1px solid #666; display:inline-block; ">合計：{{number_format($total_amount)}}円</p>
                </div>

                <div class="block" style="display: block; width:100%;padding:10px 20px 10px;">
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

                  <div class="folm_bl" style="margin-top:15px;">
                    <a>ご注文を取り消される場合は【取消】ボタンを押してください。</a>
                  </div>
                  <form action="{{ url('/mypage/orders/cancel_complete') }}" method="POST">
                  @csrf 
                  <input type="hidden" name="id" value="{{$order->id}}">
                  <div class="confirm_btn">
                      <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                      <button class="submit" type="submit" >取消</button></form>
                  </div>
                @endforeach
                </div>
        </div>
    </div>

    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>
