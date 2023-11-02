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
            <div class="form_bl">
                <a>下記の内容をご確認の上送信ボタンを押してください。<br>内容を訂正する場合は戻るを押してください。</a>
            </div>
            
            <form action="{{ url('/contact/complete') }}" method="POST" class="user_contact_form">
                @csrf 
                <?php 
                Auth::user()->id = $contact_data['id'];?>
                
                <input type=hidden name=id value="{{ $contact_data['id'] }}">
                <input type="hidden" name="Comment" value="{{$contact_data['Comment']}}">

                <p>名前</p>
                {{ Auth::user()->name }}
                <p>メールアドレス</p>
                {{ Auth::user()->email }}          
                <p>お問い合わせ内容</p>
                <td>{{$contact_data['Comment']}}</td>

                <div class="confirm_btn">
                    <button class="submit" type="submit" >送信</button> 
                    <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>