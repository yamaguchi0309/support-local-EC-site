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

    <div class="admin_main">
        <p class="page_title">更新内容確認</p>
        <div class="post">
            <div class="form_bl">
                <a>下記の内容を確認して、【登録】<br>内容を訂正する場合は、【戻る】</a>
            </div>
            
            <form action="{{ url('/admin/users/edit_complete') }}" method="POST">
                @csrf 
                <input type="hidden" name="Memo" value="{{$user_memo['Memo']}}">
                <input type="hidden" name="id" value="{{$user_memo['id']}}">
                
                @foreach($user_data as $user)
                    <?php
                        if($user->gender === "0"){
                            $Gender = "男性";
                        }elseif($user->gender === "1"){
                            $Gender = "女性";
                        }else{
                            $Gender = "回答しない";
                        }
                    ?>
               
                <p>名前</p>
                {{$user->name}}
                <p>カナ</p>
                {{$user->kana}}
                <p>メールアドレス</p>
                {{$user->email}}
                <p>電話番号</p>
                {{$user->tel}}
                <p>郵便番号</p>
                {{$user->postcode}}
                <p>住所</p>
                {{$user->address}}
                <p>誕生日（ファイル名）</p>
                {{$user->birthday}}
                <p>性別</p>
                {{$Gender}}
                <p>メモ</p>
                <td>{{$user_memo['Memo']}}</td> 
                @endforeach       

                <div class="confirm_btn">
                    <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                    <button class="submit" type="submit" >登録</button> 
                </div>
            </form>
        </div>
        </div>
    </div>

  </body>
</html>