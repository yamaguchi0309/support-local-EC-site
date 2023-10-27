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
    <div class="admin_main">
    <p class="page_title">問合一覧</p>
    <div class="post">
      <table class="admin_table">
      <tr><th>ID</th><th>userID</th><th>名前</th><th>カナ</th><th>メールアドレス</th><th>電話番号</th><th>年齢</th><th>性別</th><th>userメモ</th><th>お問い合わせ</th><th>メモ</th><th>登録日時</th><th>更新日時</th></tr>
        @foreach($contact_data as $contact)
        <tr>

            <?php
              if($contact->gender === "0"){
                  $Gender = "男性";
              }elseif($contact->gender === "1"){
                  $Gender = "女性";
              }else{
                  $Gender = "回答しない";
              }
            ?>

          <td>{{$contact->id}}</td>
          <td>{{$contact->user_id}}</td>
          <td>{{$contact->name}}</td>
          <td>{{$contact->kana}}</td>
          <td>{{$contact->email}}</td>
          <td>{{$contact->tel}}</td>
          <td>{{$contact->age}}</td>
          <td>{{$Gender}}</td>
          <td>{{$contact->user_memo}}</td>
          <td>{{$contact->comment}}</td>
          <td>{{$contact->memo}}</td>
          <td>{{$contact->created_at}}</td>
          <td>{{$contact->updated_at}}</td>          									
      
          <!--  編集ボタン -->
          <td><form action="/admin/contacts/edit?id={{$contact->id}}" method=post>
          <input type=hidden name=id value="{{$contact->id}}">
          <input type=submit class='button' value=編集> </form></td>
        
          <!-- 削除ボタン -->
          <td><form action="{{ url('/admin/contacts/delete') }}" method=post name=del>
              @method('DELETE')  
              @csrf 
          <input type=hidden name=id value="{{$contact->id}}">
          <input type=submit class='button' value=削除 onclick='return confirm("削除しますか")'></form></td>
        </tr>
        @endforeach
    </table>
    <div class="pagination">
        {{ $contact_data->links('pagination::bootstrap-4') }}
    </div>
    </div>
  </div>

  </body>
</html>