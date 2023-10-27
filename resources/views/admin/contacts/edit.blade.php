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

    @foreach($contact_data as $contact)             
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
            <form action="{{ url('/admin/contacts/edit_confirm') }}" method=post>
                @csrf 

                    <?php
                        if($contact->gender === "0"){
                            $Gender = "男性";
                        }elseif($contact->gender === "1"){
                            $Gender = "女性";
                        }else{
                            $Gender = "回答しない";
                        }
                    ?>
                <p>ID</p>{{$contact->id}}
                <p>userID</p>{{$contact->user_id}}
                <p>名前</p>{{$contact->name}}
                <p>カナ</p>{{$contact->kana}}
                <p>メールアドレス</p>{{$contact->email}}
                <p>電話番号</p>{{$contact->tel}}
                <p>年齢</p>{{$contact->age}}
                <p>性別</p>{{$Gender}}
                <p>userメモ</p>{{$contact->user_memo}}
                <p>お問い合わせ</p>{{$contact->comment}}
                
                <p>メモ<span class=required>*</span></p>
                <textarea name="Memo" class="Memo">{{$contact->memo}}</textarea>  
                <input type=hidden name=id value="{{$contact->id}}">
                <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                <button class="submit" type="submit" >更新</button> 
            </form>
            </div>
        </div>
    @endforeach
    
    <footer class="footer">
        @include('footer')
    </footer>
  </body>
</html>