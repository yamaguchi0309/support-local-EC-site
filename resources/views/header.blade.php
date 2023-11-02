
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NagasakiSasebo</title>
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('/css/base.css')}}"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
       $(function () {
        $('.btn').on('click', function () {    // signinクラスをクリックすると、
        $('.navi').toggleClass('open'); 
        })
        });

        // ヘッダー固定
        $(function(){
        var fadein = $('.fadein_down_0-1');
            // 400px スクロールしたらボタン表示
            $(window).scroll(function () {
                if ($(this).scrollTop() > 0) {
                    fadein.addClass("scrollin");
                    $('.alart').addClass('close'); 
                } else {
                    fadein.removeClass('scrollin')
                    $('.alart').removeClass('close'); 
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
<header>
    <div class="head fadein_down_0-1">
        <div class="header_upper">
            <div class="header_logo">
                <a href="{{ url('/nagasaki_sasebo') }}"><img src="{{asset('img/logo.png')}}"></a></div>
            <div class="header_icon">
                <a href="{{ url('/mypage') }}"><img src="{{asset('img/mypage_icon.png')}}" alt="mypage" style="margin:0 5px;"></a>
                <a href="{{ url('/cart') }}"><img src="{{asset('img/cart_icon.png')}}" alt="cart" style="margin:0 5px;"></a>
                </div>
                <button type="button" class="btn">
                    <img src="{{asset('img/menu.png')}}" alt="menu">
                </button>
            
        </div>

        <div class="header_lower">
        <ul class='navi'>
            <li class='menu'><a href="{{ url('/items') }}">取扱商品一覧</a></li>
            <li class='menu'><a href="{{ url('/shop') }}">店舗情報</a></li>
            <li class='menu'><a href="{{ url('/contact') }}">お問い合わせ</a></li>
        </ul>
        </div>
    </div>

    
</header>
</body>
</html>