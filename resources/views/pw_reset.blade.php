<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CafeCafe</title>
    <link rel="stylesheet" type="text/css"href="css/base.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  </head>
  <body>
    <header class="header">
        @include('header')
    </header>

    <div class="main">
        <p class="page_title">パスワードリセット</p>
        <div class="post">
          <a>パスワードをリセットするためのメールを送信しました。</pasuwa-dow></a>
          <a class="back_top" href="{{ url('/register') }}">ログイン画面に戻る</a>
        </div>
        </div>
    </div>
   
    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>