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

    <!-- データベースに登録されている内容を表示 -->
    <div class="user_main">
    <!-- <p class="page_title">詳細</p> -->
    <div class="block" style="justify-content: center;">
    
      @foreach($item_data as $item)
        <?php $item_price = $item->price * $item->tax; ?>
       
        <div class="item_info" style="display: flex; width:100%; margin:0px 20px">
            <div class="item_pic" ><img src="{{asset('img/items/'.$item->item_img)}}" ></a></div>
              <div class="item_detail" style="width:100%; ">
                <p style="font-size: 30px; padding: 0px 30px 10px;">{{$item->name}}</p>
                <p style="padding: 0 30px;  white-space: pre-wrap;">{{$item->description}}</p>
                <p style="text-align: right; padding: 10px 30px;">{{number_format($item_price)}}円</p>

                <div class="item_detail_button">          
                  <!--  在庫:0の場合のボタンの分岐 -->
                  @if($item->stock > '0')
                  <form action='/cart?Iid={{$item->id}}' method='post' class="button_cart" style="width:100%; margin-bottom:5px;">
                  <input type=hidden name=id value="{{$item->id}}">
                  <input type=submit class='button' value='カートに入れる' style="background:yellow; border:1px solid #ffff00; border-radius:10px;"></form>

                  @else
                  <form action='/contact' method='get' class="button_cart" style="width:100%;">
                  <input type=submit class='button' value='在庫切れ（問い合わせる）' style="background:yellow; border:1px solid #ffff00; border-radius:10px;"></form>
                  @endif
                  
                  <form action='/items' class="button_cart" style="width:100%;">
                  <input type=submit class='button' value=戻る style=" border-radius:10px;"></form>
                </div>
              </div>
            </div>		
        </div>  
          
        @endforeach
    </div>
  </div>

  <footer class="footer">
        @include('footer')
  </footer>

  </body>
</html>