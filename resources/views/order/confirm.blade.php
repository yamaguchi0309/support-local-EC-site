<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CafeCafe</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/base.css')}}">
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
                @foreach($cart_data as $cart)
                    @php $item_price = $cart->price * $cart->tax; @endphp
                        @csrf 
                    <div class="item_info" style="align-items: stretch; display: flex; width:100%; margin:5px 20px">
                        <div class=item_pic><a href="{{ route('item.detail', ['id'=>$cart->item_id]) }}"><img src="{{asset('img/items/'.$cart->item_img)}}"></a></div>
                        <div class="item_detail">
                            <p>{{$cart->name}}</p>
                            <p>{{number_format($item_price)}}円</p>
                        </div>
                            <p>{{$cart->quantity}}個</p>
                            <p>{{number_format($cart->amount)}}円</p>
                            @php $total_amount += $cart->amount; @endphp
                    </div>
                @endforeach

                @php $postage = '1000'; @endphp
                <form action="{{ url('/order/complete') }}" method="POST">
                @csrf 
                <input type="hidden" name="Tel" value="{{$shipping_data['Tel']}}">
                <input type="hidden" name="Postcode" value="{{$shipping_data['Postcode']}}">
                <input type="hidden" name="Address" value="{{$shipping_data['Address']}}">
                <input type="hidden" name="Amount" value="{{$total_amount}}">
                <input type="hidden" name="Postage" value="{{$postage}}">

                <p>小計：{{number_format($total_amount)}}円</p>
                <p>送料：{{number_format($postage)}}円</p>
                    @php $total_amount += $postage; @endphp
                <p>合計：{{number_format($total_amount)}}円</p>
                               
                <p>配送先電話番号</p>
                <p>{{$shipping_data['Tel']}}</p>
                <p>配送先郵便番号</p>
                <p>{{$shipping_data['Postcode']}}</p>
                <p>配送先住所</p>
                <p>{{$shipping_data['Address']}}</p>

                <div class="folm_bl">
                    <a>内容を訂正する場合は戻るボタンを押してください。</a>
                </div>
                <div class="confirm_btn">
                    <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                    <button class="submit" type="submit" >注文内容確定</button> 
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>