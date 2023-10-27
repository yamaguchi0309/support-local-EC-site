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

    <div class="concept">
        <h1>魅力溢れる本土最西端の地</h1>
        <h2>漁獲量全国2位は魚の美味しさの証</h2>
        <h2>和牛は内閣総理大臣賞（肉牛の部）を受賞</h2>
        <h2>モンドセレクション14年連続最高金賞受賞のお菓子</h2>
        <h2>約400年以上もの歴史を誇る陶磁器は国の伝統工芸</h2>
    </div>

    
    <div class="recommendation">
        <h1>おすすめ</h1>
        <div class="block">
            <div class="info">
                <div class=pic><img src="{{asset('img/items/fish_ハーブ鯖.png')}}" alt="海産物"></div>
                <div class="theme">
                        <a>ハーブ鯖</a>
                </div>
            </div>
            <div class="info">
                <div class=pic><img src="{{asset('img/items/meet_長崎和牛ステーキ.jpeg')}}" alt="畜産物"></div>
                <div class="theme">
                        <a>長崎和牛</a>
                </div>
            </div>
            <div class="info">
                <div class=pic><img src="{{asset('img/items/sweets_九十九島せんぺい.jpeg')}}" alt="お菓子"></div>
                <div class="theme">
                        <a>九十九島せんぺい</a>
                </div>
            </div>
            <div class="info">
                <div class=pic><img src="{{asset('img/items/dish_三川内焼.jpeg')}}" alt="工芸品"></div>
                <div class="theme">
                        <a>三川内焼</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        @include('footer')
    </footer>

    <div class="jump">Jump To Top</div>

  </body>
</html>