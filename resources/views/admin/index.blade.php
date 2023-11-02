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

    <div class="main">
        <p class="page_title">お問い合せ</p>
        <div class="post">
            <div class="form_bl">
              <a>お問い合わせ頂きありがとうございます。<br>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。<br></a>
            </div>
            <a class="back_top" href="{{ url('/home') }}">トップに戻る</a>
        </div>
        </div>
    </div>
   
    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>