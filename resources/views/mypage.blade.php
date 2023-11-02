<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NagasakiSasebo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/base.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
  </head>
  <body>
    <header class="header">
        @include('header')
    </header>

      <div class="user_main">
        <p class="page_title">{{ Auth::user()->name }}様 マイページ</p>
        <div class="post">
            <td><form action="/mypage/orders" method=post>
            <input type=hidden name=id value="{{ Auth::user()->id }}">
            <input type=submit class='back_top' value=注文履歴確認/注文取消></form></td>

            <td><form action="/mypage/edit?id={{ Auth::user()->id }}" method=post>
            <input type=hidden name=id value="{{ Auth::user()->id }}">
            <input type=submit class='back_top' value=会員情報更新></form></td>
        
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a class="back_top" href="route('logout')" style="background-color: #ffffff; color: #1f2d56; border: 2px solid #1f2d56;"
          onclick="event.preventDefault();this.closest('form').submit();">
            ログアウト</a>
        </form>
        </div>
      </div>

    <footer class="footer">
          @include('footer')
    </footer>
</body>
</html>