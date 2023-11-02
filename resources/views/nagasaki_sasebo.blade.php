<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NagasakiSasebo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/base.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        // ページトップジャンプ
        $(function(){
        var pagetop = $('.jump');
            // ボタン非表示
            pagetop.hide();
            // 400px スクロールしたらボタン表示
            $(window).scroll(function () {
                if ($(this).scrollTop() > 400) {
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
    <body class="home">
    <header class="header">
        @include('header')
    </header>
    </body>

    <div class="concept" style="position:absolute; height:500px; top:200px; right:150px; -ms-writing-mode: tb-rl;writing-mode: vertical-rl;">
        <h1>魅力溢れる本土最西端の地</h1>
        <p>漁獲量全国二位は魚の美味しさの証</p>
        <p>肉牛の部で内閣総理大臣賞を受賞</p>
        <p>モンドセレクション十四年連続最高金賞受賞のお菓子</p>
        <p>約四〇〇年以上もの歴史を誇る陶磁器は国の伝統工芸</p>
    </div>

    
    <div class="recommendation">
        <h1>おすすめ</h1>
        <div class="block">
            <div class="info">
                <div class="item_pic-items"><a href="{{ route('item.detail', ['id'=>'1']) }}">
                    <img src="{{asset('img/items/fish_九十九島産 長崎ハーブ鯖 お刺身 150g.png')}}" alt="海産物" style="width:100%;"></a></div>
                <div class="theme"><a>ハーブ鯖</a></div>
            </div>
            <div class="info">
                <div class="item_pic-items"><a href="{{ route('item.detail', ['id'=>'2']) }}">
                    <img src="{{asset('img/items/meet_長崎和牛サーロインステーキ 180g×3枚.jpeg')}}" alt="畜産物" style="width:100%;"></div>
                <div class="theme"><a>長崎和牛</a></div>
            </div>
            <div class="info">
                <div class="item_pic-items"><a href="{{ route('item.detail', ['id'=>'3']) }}">
                    <img src="{{asset('img/items/sweets_九十九島せんぺい 12枚入り.jpeg')}}" alt="お菓子" style="width:100%;"></div>
                <div class="theme"><a>九十九島せんぺい</a></div>
            </div>
            <div class="info">
                <div class="item_pic-items"><a href="{{ route('item.detail', ['id'=>'4']) }}">
                    <img src="{{asset('img/items/item_三川内焼 唐子絵飯碗大小.jpeg')}}" alt="工芸品" style="width:100%;"></div>
                <div class="theme"><a>三川内焼</a></div>
            </div>
        </div>
    </div>

    <footer class="footer">
        @include('footer')
    </footer>

    <div class="jump">Jump To Top</div>

  </body>
</html>