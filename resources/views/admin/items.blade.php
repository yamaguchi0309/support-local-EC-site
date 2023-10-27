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
    <p class="page_title">登録商品一覧</p>
    <div class="post">
      <table class="admin_table">
      <tr><th>ID</th><th>商品名</th><th>商品説明</th><th>単価</th><th>税率</th><th>在庫</th><th>販売/停止</th><th>商品画像</th><th>メモ</th><th>登録日時</th><th>更新日時</th></tr>
        @foreach($item_data as $item)
        <tr>
          <td>{{$item->id}}</td>
          <td>{{$item->name}}</td>
          <td>{{$item->description}}</td>
          <td>{{$item->price}}</td>
          <td>{{$item->tax}}</td>
          <td>{{$item->stock}}</td>
          <td>{{$item->is_selling}}</td>
          <td>{{$item->item_img}}</td>
          <td>{{$item->memo}}</td>
          <td>{{$item->created_at}}</td>
          <td>{{$item->updated_at}}</td>          									
      
          <!--  編集ボタン -->
          <td><form action="/admin/items/edit?id={{$item->id}}" method=post>
          <input type=hidden name=id value="{{$item->id}}">
          <input type=submit class='button' value=編集> </form></td>
        
          <!-- 削除ボタン -->
          <td><form action="{{ url('/admin/items/delete') }}" method=post name=del>
              @method('DELETE')  
              @csrf 
          <input type=hidden name=id value="{{$item->id}}">
          <input type=submit class='button' value=削除 onclick='return confirm("削除しますか")'> </form></td>
        </tr>
        @endforeach
    </table>
    <div class="pagination">
        {{ $item_data->links('pagination::bootstrap-4') }}
    </div>
    </div>
  </div>

  <div class="admin_main" style="width: 60%;">
        <p class="page_title">商品登録</p>
        <div class="post">
            <div class="folm_bl">
              <a>「<span class=required>*</span>」は必須項目<br>
                  メモの末尾には、名前と記入日時を記載</a>
            </div>

            <div>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>

            <form action="{{ url('/admin/items/confirm') }}" method="POST">
              @csrf 
              <p>商品名<span class=required>*</span></p>
              <input name="Name" class="Name" type="text" value="{{ old('Name') }}"/>
              <p>商品説明<span class=required>*</span></p>
              <textarea name="Description" class="Description">{{ old('Description') }}</textarea>
              <p>単価<span class=required>*</span></p>
              <input name="Price" class="Price" type="text" value="{{ old('Price') }}"/>
              <p>税率<span class=required>*</span></p>
              <input type="radio" name="Tax" class="Tax"  value="1.08" {{ old ('Tax') == '1.08' ? 'checked' : '' }} checked/>1.08
              <input type="radio" name="Tax" class="Tax"  value="1.10" {{ old ('Tax') == '1.10' ? 'checked' : '' }} checked/>1.10
              <p>在庫<span class=required>*</span></p>
              <input name="Stock" class="Stock" type="text" value="{{ old('Stock') }}"/>
              <p>販売状況<span class=required>*</span></p>
              <input type="radio" name="Is_selling" class="Is_selling"  value="1" {{ old ('Is_selling') == '販売' ? 'checked' : '' }} checked/>販売
              <input type="radio" name="Is_selling" class="Is_selling"  value="0" {{ old ('Is_selling') == '停止' ? 'checked' : '' }} checked/>停止
              <p>商品画像<span class=required>*</span>（ファイル名）</p>
              <input name="Item_img" class="Item_img" type="text" value="{{ old('Item_img') }}"/>
              <p>メモ</p>
              <textarea name="Memo" class="Memo">{{ old('Memo') }}</textarea>  
              <button class="submit" type="submit">送信</button>
            </form>
        </div>
        </div>
  </div>

  </body>
</html>