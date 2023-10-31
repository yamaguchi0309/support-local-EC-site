<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CafeCafe</title>
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
                if ($(this).scrollTop() > 200) {  // 200px スクロールしたらボタン表示
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
      <p class="page_title">取扱商品一覧</p>

      <!-- 検索機能ここから -->
      <div style="display:flex;flex-wrap: wrap;justify-content: center;">
        <form action="{{ route('search.items') }}" method="GET" style=" text-align: center; width:70%;">
        @csrf
          <input type="text" name="keyword" value="{{ $keyword }}" style=" width:60%;">
          <input type="submit" value="検索" style="width:50px;">
        </form>
      </div>
        
        <div class="block-items">
        @foreach($item_data as $item)
          <?php $item_price = $item->price * $item->tax; ?>
        
          <div class="item_info-items" style="">
            <div class=item_pic-items><a href="{{ route('item.detail', ['id'=>$item->id]) }}"><img src="{{asset('img/items/'.$item->item_img)}}"></a></div>
            <p style="">{{$item->name}}</p>
            <p style="">{{number_format($item_price)}}円</p>								
        
            <!--  在庫:0の場合のボタンの分岐 -->
            @if($item->stock > '0')
            <form action='/cart?Iid={{$item->id}}' method='post' class='button_cart' style="margin: 5px auto;">
            <input type=hidden name=id value="{{$item->id}}">
            <input type=submit class='button' value='カートに入れる' style="background:yellow;border:1px solid #ffff00; border-radius:10px;"></form>
            @else
            <form action='/contact' method='get'  class='button_cart'>
            <input type=submit class='button' value='在庫切れ（問い合わせる）' style="background:yellow; border:1px solid #ffff00; border-radius:10px;"></form>
            @endif
          </div>  
        @endforeach
      </div>
    </div>
    
  <div class="pagination">
  {{ $item_data->links('pagination::bootstrap-4') }}
  </div>

  <footer class="footer">
        @include('footer')
  </footer>

  <div class="jump">Jump To Top</div>

  </body>
</html>