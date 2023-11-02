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
        <p class="page_title">お問い合せ</p>
        <div class="post">
            <div class="user_contact_form_bl">
              <h1 style="text-align: center;  margin:1% auto;">お問い合わせ内容をご記入の上、送信ボタンを押してください</h1>
              <a style=" margin:1% auto;">送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
                  なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。<br>
              </a>
            </div>
            <div style="color:red;">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            <form action="{{ url('/contact/confirm') }}" method="POST" class="user_contact_form">
              @csrf 

              <p style="padding-left:1%; font-weight:bold;">名前</p>
              <p style="padding-left:1%;">{{ Auth::user()->name }}</p>
              <p style="padding-left:1%; font-weight:bold;">メールアドレス</p>
              <p style="padding-left:1%;">{{ Auth::user()->email }}</p>
              <h1 style="font-weight:bold;">お問い合わせ内容<span class=required>*</span></h1>
              <textarea name="Comment" class="comment">{{ old('Comment') }}</textarea>

              <input type=hidden name=id value="{{ Auth::user()->id }}">
              <button class="submit" type="submit">送信</button>
            </form>
        </div>
        </div>
    </div>

  <footer class="footer">
      @include('footer')
  </footer>
  </body>
</html>