<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CafeCafe</title>
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
            <div class="folm_bl">
              <h1 style="text-align: center;">お問い合わせ内容をご記入の上、送信ボタンを押してください</h1>
              <a>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
                  なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。<br>
              </a>
            </div>
            <div>
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            <form action="{{ url('/contact/confirm') }}" method="POST">
              @csrf 

              <p>名前</p>
              {{ Auth::user()->name }}
              <p>メールアドレス</p>
              {{ Auth::user()->email }}
              <h1>お問い合わせ内容<span class=required>*</span></h1>
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