<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NagasakiSasebo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/base.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  </head>
  <body>
    <header class="header">
        @include('header')
    </header>

        <div class=main>
            <p class=fsize>削除完了</p>
        </div>
   
    <div class="post">
        <a class="back_top" href="{{ url('/home') }}">トップに戻る</a>
    </div>
</body>
</html>