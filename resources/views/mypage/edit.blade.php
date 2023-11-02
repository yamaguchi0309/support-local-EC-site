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

    @foreach($user_data as $user)             
        <div class=admin_main>
        <p class=page_title>会員情報更新</p>
            <div>
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            <div class=post>
            <form action="{{ url('/mypage/edit_confirm') }}" method=post class="user_mypage_form">
                @csrf 
               
                <p>名前<span class=required>*</span></p>
                <input name="Name" class="Name" type="text" value="{{$user->name}}"/>
                <p>カナ<span class=required>*</span></p>
                <input name="Kana" class="Kana" type="text" value="{{$user->kana}}"/>
                <p>メールアドレス<span class=required>*</span></p>
                <input name="Email" class="Email" type="text" value="{{$user->email}}"/>
                <p>電話番号<span class=required>*</span></p>
                <input name="Tel" class="Tel" type="text" value="{{$user->tel}}"/>
                <p>郵便番号（ハイフン無し）<span class=required>*</span></p>
                <input name="Postcode" class="Postcode" type="text" value="{{$user->postcode}}"/>
                <p>住所<span class=required>*</span></p>
                <input name="Address" class="Address" type="text" value="{{$user->address}}"/>
                <p>誕生日<span class=required>*</span>（ファイル名）</p>
                <input name="Birthday" class="Birthday" type="text" value="{{$user->birthday}}"/>
                <p>性別<span class=required>*</span></p>
                <input type="radio" name="Gender" class="Gender"  value="0" @if(old ('Gender',$user->gender) == '0') ? 'checked' : '' checked/ @endif>男性
                <input type="radio" name="Gender" class="Gender"  value="1" @if(old ('Gender',$user->gender) == '1') ? 'checked' : '' checked/ @endif>女性
                <input type="radio" name="Gender" class="Gender"  value="2" @if(old ('Gender',$user->gender) == '2') ? 'checked' : '' checked/ @endif>回答しない
                
                <input type=hidden name=id value="{{$user->id}}">
                <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                <button class="submit" type="submit" >確認</button> 
            </form>
            </div>
        </div>
    @endforeach
    
    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>