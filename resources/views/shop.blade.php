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
    
    
    <header class="header">
        @include('header')
    </header>
   
    <div class="user_main">
        <p class="page_title">店舗情報</p>
        <div class="post">
            <div class="folm_msg">
                <h2> 住所 </h2>
                <a>〒XXX-XXXX<br>東京都千代田区丸の内X-X-X<br>東京駅丸の内北口より徒歩 3分</a>
            </div>
        </div>
       
        <div class="post">   
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.737749644387!2d139.76382551109486!3d35.68345887247218!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188bf91efa97d9%3A0x17b6702ba591fbf3!2z5Li444Gu5YaF44Kq44Ki44K-!5e0!3m2!1sja!2sjp!4v1698451783593!5m2!1sja!2sjp" 
                    width="500" height="350" style="border:0; display:block; margin:15px auto;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    
        <div class="post">
            <div class="folm_msg">
                <h2> 電話番号 </h2>
                <a>03-XXXX-XXXX</a>
            </div>
        </div>

        <div class="post">
            <div class="folm_msg">
                <h2> 営業時間 </h2>
                <a>10:00〜20:00<br>
                定休日:毎週月曜日</a>
            </div>
        </div>
    
    </div>

    <footer class="footer">
        @include('footer')
    </footer>

    <div class="jump">Jump To Top</div>

  </body>
</html>