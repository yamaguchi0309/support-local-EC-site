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
      <div>
          <form action="{{ route('search.items') }}" method="GET">
          @csrf
            <input type="text" name="keyword" value="{{ $keyword }}">
            <input type="submit" value="検索">
          </form>
        </div>
      <div class="block" style="flex-wrap: wrap; justify-content: flex-start; column-gap: 5%; margin: 0 50px;">
        @foreach($item_data as $item)
          <?php $item_price = $item->price * $item->tax; ?>
        
          <div class="item_info" style="align-items: stretch;">
            <div class=item_pic><a href="{{ route('item.detail', ['id'=>$item->id]) }}"><img src="{{asset('img/items/'.$item->item_img)}}"></a></div>
            <p style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{$item->name}}</p>
            <p>{{number_format($item_price)}}円</p>									
        
            <!--  在庫:0の場合のボタンの分岐 -->
            @if($item->stock > '0')
            <form action='/cart?Iid={{$item->id}}' method='post'  class='button_cart'>
            <input type=hidden name=id value="{{$item->id}}">
            <input type=submit class='button' value='カートに入れる'></form>
            @else
            <form action='/contact' method='get'  class='button_cart'>
            <input type=submit class='button' value='在庫切れ（問い合わせる）'></form>
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