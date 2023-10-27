<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CafeCafe</title>
    <link rel="stylesheet" type="text/css"href="{{asset('/css/base.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  </head>
  <body>
    <header class="header">
        @include('header')
    </header>

    <div class="main">
        <p class="page_title">注文受付完了</p>
        <div class="post">
              <a>ご注文頂きありがとうございます。<br>
              ご注文内容のご確認/お取消は、マイページから行えます。</a>
              <a class="back_top" href="{{ url('/mypage') }}">マイページ</a>
        </div>
        </div>
    </div>
   
    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>