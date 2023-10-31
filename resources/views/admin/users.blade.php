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
    <div class="back_setting">
      <a href="{{ url('/admin/setting') }}">管理画面に戻る</a>
    </div>

    <!-- データベースに登録されている内容を表示 -->
    <div class="admin_main" style="width: 95%;" >
    <p class="page_title">会員一覧</p>
    <!-- 検索機能ここから -->
    <div style="display:flex;flex-wrap: wrap;justify-content: center; margin-bottom:20px;">
        <form action="{{ route('admin.search.users') }}" method="GET" style=" text-align: center; width:70%;">
        @csrf
          <input type="text" name="keyword" value="{{ $keyword }}" style=" width:60%;">
          <input type="submit" value="検索" style="width:50px;">
        </form>
    </div>
    <div class="post">
      <table class="admin_table">
      <tr><th>ID</th><th>名前</th><th>カナ</th><th>メールアドレス</th><th>電話番号</th><th>郵便番号</th><th>住所</th><th>誕生日</th><th>性別</th><th>メモ</th><th>登録日時</th><th>更新日時</th></tr>
        @foreach($user_data as $user)
        <tr>

            <?php
              if($user->gender === "0"){
                  $Gender = "男性";
              }elseif($user->gender === "1"){
                  $Gender = "女性";
              }else{
                  $Gender = "回答しない";
              }
            ?>

          <td style="width:4%;">{{$user->id}}</td>
          <td style="width:4%;">{{$user->name}}</td>
          <td style="width:4%;">{{$user->kana}}</td>
          <td style="width:4%;">{{$user->email}}</td>
          <td style="width:4%;">{{$user->tel}}</td>
          <td style="width:4%;">{{$user->postcode}}</td>
          <td style="overflow:scroll; text-overflow:clip; width:16%;">{{$user->address}}</td>
          <td style="width:8%;">{{$user->birthday}}</td>
          <td>{{$Gender}}</td>
          <td style="overflow:scroll; text-overflow:clip;">{{$user->memo}}</td>
          <td style="overflow:scroll; text-overflow:clip; width:8%;">{{$user->created_at}}</td>
          <td style="overflow:scroll; text-overflow:clip; width:8%;">{{$user->updated_at}}</td>          									
      
          <!--  編集ボタン -->
          <td style="max-width:25px;"><form action="/admin/users/edit?id={{$user->id}}" method=post>
          <input type=hidden name=id value="{{$user->id}}">
          <input type=submit class='button' value=メモ追記></form></td>
        
          <!-- 削除ボタン -->
          <td style="max-width:25px;"><form action="{{ url('/admin/users/delete') }}" method=post name=del>
              @method('DELETE')  
              @csrf 
          <input type=hidden name=id value="{{$user->id}}">
          <input type=submit class='button' value=削除 onclick='return confirm("削除しますか")'></form></td>
        </tr>
        @endforeach
    </table>
    <div class="pagination">
        {{ $user_data->links('pagination::bootstrap-4') }}
    </div>
    </div>
  </div>

  </body>
</html>