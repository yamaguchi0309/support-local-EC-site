<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NagasakiSasebo</title>
    <link rel="stylesheet" type="text/css"href="{{asset('/css/base.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  </head>
  <body>
    <header class="header">
        @include('header')
    </header>

    <div class="admin_main">
        <p class="page_title">会員情報更新完了</p>
        <div class="post">
              <a class="back_top" href="{{ url('/mypage') }}">マイページに戻る</a>
        </div>
        </div>
    </div>
   
    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>