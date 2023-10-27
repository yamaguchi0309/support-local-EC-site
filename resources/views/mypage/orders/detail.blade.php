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
        下記の内容をご確認の上、注文確定ボタンを押してください。
        <div class="block" style="flex-wrap: wrap; justify-content: flex-start; column-gap: 5%; margin: 0 50px;">
                
              @php $total_amount = '0'; @endphp
              @foreach($order_detail_data as $order_detail)
                    @php $item_price = $order_detail->price * $order_detail->tax; @endphp
                        @csrf 
                    <div class="item_info" style="align-items: stretch; display: flex; width:100%; margin:5px 20px">
                        <div class=item_pic><a href="{{ route('item.detail', ['id'=>$order_detail->item_id]) }}"><img src="{{asset('img/items/'.$order_detail->item_img)}}"></a></div>
                        <div class="item_detail">
                            <p>{{$order_detail->name}}</p>
                            <p>{{number_format($item_price)}}円</p>
                        </div>
                            <p>{{$order_detail->quantity}}個</p>
                            <p>{{number_format($order_detail->amount)}}円</p>
                    </div>
              @endforeach

              <div class="block" style="display: block; width:100%">
              @foreach($order_data as $order)

                <p>小計：{{number_format($order->amount)}}円</p>
                <p>送料：{{number_format($order->postage)}}円</p>
                  @php $total_amount = $order->amount + $order->postage; @endphp
                <p>合計：{{number_format($total_amount)}}円</p>

                <p>配送先電話番号</p>
                <p>{{$order->shipping_tel}}</p>
                <p>配送先郵便番号</p>
                <p>{{$order->shipping_postcode}}</p>
                <p>配送先住所</p>
                <p>{{$order->shipping_address}}</p>
                
                <div class="folm_bl">
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
