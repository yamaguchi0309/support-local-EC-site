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
   

    <div class="main">
        <p class="page_title">店舗情報</p>
        <div class="post">
            <div class="folm_msg">
                <h2> 住所 </h2>
                <a>〒XXX-XXXX<br>東京都千代田区丸の内X-X-X<br>東京駅丸の内北口より徒歩 3分</a>
            </div>
        </div>
       
        <div class="post">
            <div class="location">

            
        <?php
            mb_language("Japanese");//文字コードの設定
            mb_internal_encoding("UTF-8");

            //住所を入れて緯度経度を求める。
            $address = "佐世保市役所";
            $myKey = "AIzaSyDMqI6BgNXJ3S_AME5qFZNd1i8yIWbj6Jw";

            $address = urlencode($address);

            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "+CA&key=" . $myKey ;


            $contents= file_get_contents($url);
            $jsonData = json_decode($contents,true);

            $lat = $jsonData["results"][0]["geometry"]["location"]["lat"];
            $lng = $jsonData["results"][0]["geometry"]["location"]["lng"];
            print("lat=$lat\n");
            print("lng=$lng\n");
        ?>
        
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13357.220882752486!2d129.7152266!3d33.1798625!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x356a943f3f167d2f%3A0x2ecc181a861e3a78!2z5L2Q5LiW5L-d5biC5b255omA!5e0!3m2!1sja!2sjp!4v1698317984695!5m2!1sja!2sjp" width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


                <a>google map</a>
            </div>
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