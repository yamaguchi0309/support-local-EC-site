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

    <div class="contact">
        <p class="page_title">お問い合せ</p>
        <div class="post">
            <div class="folm_bl">
              <h1>下記項目をご記入の上、送信ボタンを押してください</h1>
              <a>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
                  なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。<br>
                  <span class=required>*</span>は必須項目となります。
              </a>
            </div>
            <div>
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            <form action="{{ url('confirm') }}" method="POST">
              @csrf 
              <p>氏名<span class=required>*</span></p>
              <input name="Name" class="Name" type="text" placeholder="山田太郎" value="{{ old('Name') }}"/>
              <p>フリガナ<span class=required>*</span></p>
              <input name="Furigana" class="Furigana" type="text" placeholder="ヤマダタロウ" value="{{ old('Furigana') }}"/>
              <p>電話番号</p>
              <input name="Tel" class="Tel" type="tel" placeholder="09012345678" value="{{ old('Tel') }}"/>
              <p>メールアドレス<span class=required>*</span></p>
              <input name="Email" class="Email" type="email" placeholder="test@test.co.jp" value="{{ old('Email') }}"/>
              <h1>お問い合わせ内容をご記入ください<span class=required>*</span></h1>
              <textarea name="Textarea" class="textarea">{{ old('Textarea') }}</textarea>  
              <button class="submit" type="submit">送信</button>
            </form>
        </div>
        </div>
    </div>

    <!-- データベースに登録されている内容を表示 -->
    <div class="contact">
    <p class="page_title">お問い合せ内容一覧</p>
    <div class="post">

      <table class="cafe_table">
      <tr><th>ID</th><th>氏名</th><th>フリガナ</th><th>電話番号</th><th>メールアドレス</th><th>お問い合わせ内容</th></tr>
        @foreach($user_data as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->kana}}</td>
          <td>{{$user->tel}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->body}}</td>
      
          <!--  編集ボタン -->
          <td style="max-width:20px;"><form action="/edit?id={{$user->id}}" method=post>
          <input type=hidden name=id value="{{$user->id}}">
          <input type=submit class='button' value=編集> </form></td>
        
          <!-- 削除ボタン -->
          <td style="max-width:20px;"><form action="{{ url('delete') }}" method=post name=del>
              @method('DELETE')  
              @csrf 
          <input type=hidden name=id value="{{$user->id}}">
          <input type=submit class='button' value=削除 onclick='return confirm("削除しますか")'> </form></td>
        </tr>
        @endforeach
    </table>
    <div class="pagination">
        {{ $user_data->links('pagination::bootstrap-4') }}
    </div>
    </div>
  </div>

  <footer class="footer">
      @include('footer')
  </footer>
  </body>
</html>