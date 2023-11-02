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

    <div class="admin_main">
        <p class="page_title">更新内容確認</p>
        <div class="post">
            <div class="form_bl">
                <a>下記の内容を確認して【更新】<br>内容を訂正する場合は【戻る】</a>
            </div>
            
            <form action="{{ url('/mypage/edit_complete') }}" method="POST" class="user_mypage_form">
                @csrf 

                <input type="hidden" name="id" value="{{$user_data['id']}}">
                <input type="hidden" name="Name" value="{{$user_data['Name']}}">
                <input type="hidden" name="Kana" value="{{$user_data['Kana']}}">
                <input type="hidden" name="Email" value="{{$user_data['Email']}}">
                <input type="hidden" name="Tel" value="{{$user_data['Tel']}}">
                <input type="hidden" name="Postcode" value="{{$user_data['Postcode']}}">
                <input type="hidden" name="Address" value="{{$user_data['Address']}}">
                <input type="hidden" name="Birthday" value="{{$user_data['Birthday']}}">
                <input type="hidden" name="Gender" value="{{$user_data['Gender']}}">

                    <?php
                        if($user_data['Gender'] === "0"){
                            $Gender = "男性";
                        }elseif($user_data['Gender'] === "1"){
                            $Gender = "女性";
                        }else{
                            $Gender = "回答しない";
                        }
                    ?>

                <p>名前</p>
                    <td>{{$user_data['Name']}}</td>
                <p>カナ</p>
                    <td>{{$user_data['Kana']}}</td>            
                <p>メールアドレス</p>
                    <td>{{$user_data['Email']}}</td>
                <p>電話番号</p>
                    <td>{{$user_data['Tel']}}</td>            
                <p>郵便番号</p>
                    <td>{{$user_data['Postcode']}}</td>
                <p>住所</p>
                    <td>{{$user_data['Address']}}</td>
                <p>誕生日</p>
                    <td>{{$user_data['Birthday']}}</td> 
                <p>性別</p>
                    <td>{{$Gender}}</td>            

                <div class="confirm_btn">
                    <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                    <button class="submit" type="submit" >更新</button> 
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