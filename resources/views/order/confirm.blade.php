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
                    <div class=item_pic><img src="{{asset('img/items/'.$cart->item_img)}}" style="margin-right:20px; width:100px; height:100px;"></div>
                    <div class="item_detail" style="display:flex; width:100%;">
                        <p style="text-align:left; width:60%; margin-top:11px;">{{$cart->name}}</p>
                        <p style="text-align:right; width:10%; margin-top:11px;">{{number_format($item_price)}}円</p>
                        <p style="text-align:right; width:10%; margin-top:11px;">{{$cart->quantity}}個</p>
                        <p style="text-align:right; width:25%; font-weight:bold;  margin-top:11px;">計：{{number_format($cart->amount)}}円</p>
                        @php $total_amount += $cart->amount; @endphp
                    </div>
                </div>
            @endforeach

            @php $postage = '1000'; @endphp
            <div style="display:block; padding:10px 20px 10px; border-top: 1px solid #666;border-bottom: 1px solid #666; width:100%;">
                <p style="text-align:right; padding:5px 0px; font-weight:bold;">小計：{{number_format($total_amount)}}円</p>
                <p style="text-align:right; padding:5px 0px; font-weight:bold;">送料：&nbsp;&nbsp;{{number_format($postage)}}円</p>
                    @php $total_amount += $postage; @endphp
                <p style="text-align:right; padding:5px 0px; font-weight:bold; float:right; border-top: 1px solid #666; display:inline-block; ">合計：{{number_format($total_amount)}}円</p>
            </div>

            <div class="block" style="display: block; width:100%;padding:10px 20px 10px;">
                <div style="display:flex;  border-bottom: 1px solid #666; margin-top:5px;">
                <p style="text-align:left;">配送先電話番号</p>
                <p style="margin:0 0 0 auto;">{{$shipping_data['Tel']}}</p>
                </div>
                <div style="display:flex; border-bottom: 1px solid #666; margin-top:5px;">
                    <p style="text-align:left;">配送先郵便番号</p>
                    <p style="margin:0 0 0 auto;">{{$shipping_data['Postcode']}}</p>
                </div>
                <div style="display:flex; border-bottom: 1px solid #666; margin-top:5px;">
                    <p style="text-align:left;">配送先住所</p>
                    <p style="text-align:right; width:75%; margin:0 0 0 auto;">{{$shipping_data['Address']}}</p>
                </div>
            

                <form action="{{ url('/order/complete') }}" method="POST">
                @csrf 
                <input type="hidden" name="Tel" value="{{$shipping_data['Tel']}}">
                <input type="hidden" name="Postcode" value="{{$shipping_data['Postcode']}}">
                <input type="hidden" name="Address" value="{{$shipping_data['Address']}}">
                <input type="hidden" name="Amount" value="{{$total_amount}}">
                <input type="hidden" name="Postage" value="{{$postage}}">

                <div class="folm_bl" style="margin-top:15px;">
                    <a>※内容を訂正する場合は戻るボタンを押してください。</a>
                </div>
                <div class="confirm_btn">
                    <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                    <button class="submit" type="submit" >注文内容確定</button></form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>