<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NagasakiSasebo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/base.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
    <script>
        // ページトップジャンプ
        $(function(){
        var pagetop = $('.jump');
            pagetop.hide();                       // ボタン非表示
            $(window).scroll(function () {
                if ($(this).scrollTop() > 600) {  // 600px スクロールしたらボタン表示
                    pagetop.fadeIn();
                } else {
                    pagetop.fadeOut();
                }
            });
            pagetop.click(function () {
                $('body, html').animate({ scrollTop: 0 }, 500);
                return false;
            });
        });
    </script>
  </head>
  <body>
    <header class="header">
        @include('header')
    </header>

    <!-- データベースに登録されている内容を表示 -->
    <div class="user_main">
      <p class="page_title">{{ Auth::user()->name }}様のカート</p>
      <div class="user_order_main_block" style="">

        @php $total_amount = '0'; @endphp
        @foreach($cart_data as $cart)
          @php $item_price = $cart->price * $cart->tax; @endphp    
          <div class="item_info" style="display:flex; width:100%;  padding:10px; border-radius:10px; background:#ff000024;">
            <div class="user_order_detail_item_pic"><a href="{{ route('item.detail', ['id'=>$cart->item_id]) }}"><img src="{{asset('img/items/'.$cart->item_img)}}" style="; "></a></div>
            <div class="user_cart_detail_item_detail" style="display:block; width:100%;">
            <div style="display:flex; justify-content: space-between;">
              <p style="text-align:left; width:40%;">{{$cart->name}}</p>
              <p style="text-align:right; width:20%;">{{number_format($item_price)}}円</p>
              
              <!--  個数変更 -->
              <form action='/cart' method=post class='button_cart'style=" width:50px;">
              @method('PATCH')
              @csrf
              <input type=text name="Quantity" value="{{$cart->quantity}}"style="text-align:center;height:20%;">
              <input type=hidden name=Iid value='{{$cart->item_id}}'>
              <input type=submit class='cart_button' value='変更' style="bottom: 0; right:0;"></form>
            
              @php $cart->quantity = 0; @endphp
              
              <!--  カートから削除 -->
              <form action='/cart' method=post class='form_cart_button' style="">
              @method('PATCH') 
              @csrf
              <p class="user_cart_delite_p" style="width: 100%;">計：{{number_format($cart->amount)}}円</p>
              @php $total_amount += $cart->amount; @endphp
              <input type=hidden name="Quantity" value="{{$cart->quantity}}">
              <input type=hidden name=Iid value='{{$cart->item_id}}'>
              <input type=submit class='cart_button' value='削除' style="" onclick='return confirm("削除しますか")'></form>
            </div> 
            </div>
          </div>  
        @endforeach       

        @if(empty($cart_data))
        <div style="margin:0 auto;">
          <p style="text-align:center; font-size:28px;">カートは空です</p>
          <div class="confirm_btn" style="margin:5px;">
              <button class="back_btn" type="button" onclick="location.href='/items'">買い物を続ける</button>
          </div>
        </div>
        @else
        <div style="display:block; padding:10px 10px 10px; border-top: 1px solid #666;border-bottom: 1px solid #666;width:100%;">
            <p style="text-align:right; padding:5px 10px; font-weight:bold;">小計：{{number_format($total_amount)}}円</p>
        </div>
        

            <div class="block" style="display: block; width:100%; margin:0 10px;">
            <form action="{{ url('/order/confirm') }}" method=post>
                @csrf 
              <p class="user_cart_shipping_p"style="">■配送先が会員情報と異なる場合は、下記を編集してください。<br><span class="requierd" style="font-size:12px;">※会員情報が更新されることはありません</span></@>

              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach

                @php $user_tel=Auth::user()->tel; 
                     $user_postcode=Auth::user()->postcode; 
                     $user_address=Auth::user()->address; @endphp

              
              <div style="display:flex; margin-top:5px;">
                  <p style="text-align:left;width:37%; margin:auto 0px;">配送先電話番号<span class=required>*</span></p>
                  <input name="Tel" class="Tel" type="text" value="{{$user_tel}}" style=""/>
                </div>
                <div style="display:flex;  margin-top:5px;">
                  <p style="text-align:left; width:37%;margin:auto 0px;">配送先郵便番号(ハイフン無し)<span class=required>*</span></p>
                  <input name="Postcode" class="Postcode" type="text" value="{{$user_postcode}}" style=""/>
                </div>
                <div style="display:flex;  margin-top:5px;">
                  <p style="text-align:left; width:37%;margin:auto 0px;">配送先住所<span class=required>*</span></p>
                  <input name="Address" class="Address" type="text" value="{{$user_address}}" style=""/>
                  </div>
              <div class="confirm_btn">
                <button class="back_btn" type="button" onclick="location.href='/items'">買い物を続ける</button>
                <button class="submit" type="submit" >注文する</button> 
              </div>
            </div>
        @endif
      </div>  
    </div>

  <footer class="footer">
        @include('footer')
  </footer>

  <div class="jump">Jump To Top</div>

  </body>
</html>