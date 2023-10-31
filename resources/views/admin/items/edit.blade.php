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

    @foreach($item_data as $item)             
        <div class=admin_main>
        <p class=page_title>登録商品内容編集</p>
            <div>
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            <div class=post>
            <form action="{{ url('/admin/items/edit_confirm') }}" method=post>
                @csrf 
               
                <p>商品名<span class=required>*</span></p>
                <input name="Name" class="Name" type="text" value="{{$item->name}}"/>
                <p>商品説明<span class=required>*</span></p>
                <textarea name="Description" class="Description">{{$item->description}}</textarea>
                <p>単価<span class=required>*</span></p>
                <input name="Price" class="Price" type="text" value="{{$item->price}}"/>
                <p>税率<span class=required>*</span></p>
                <input type="radio" name="Tax" class="Tax"  value="1.08" @if(old ('Tax',$item->tax) == '1.08') ? 'checked' : '' checked/ @endif>1.08
                <input type="radio" name="Tax" class="Tax"  value="1.10" @if(old ('Tax',$item->tax) == '1.10') ? 'checked' : '' checked/ @endif>1.10
                <p>在庫<span class=required>*</span></p>
                <input name="Stock" class="Stock" type="text" value="{{$item->stock}}"/>
                <p>販売状況<span class=required>*</span></p>
                <input type="radio" name="Is_selling" class="Is_selling"  value="1" @if(old ('Is_selling',$item->is_selling) == '1') ? 'checked' : '' checked/ @endif>販売
                <input type="radio" name="Is_selling" class="Is_selling"  value="0" @if(old ('Is_selling',$item->is_selling) == '0') ? 'checked' : '' checked/ @endif>停止
                <p>商品画像<span class=required>*</span>（ファイル名）</p>
                <input name="Item_img" class="Item_img" type="text" value="{{$item->item_img}}"/>
                <p>メモ</p>
                <textarea name="Memo" class="Memo">{{$item->memo}}</textarea>  
                <p>登録日時</p>{{$item->created_at}}
                <p>更新日時</p>{{$item->updated_at}}      
                <input type=hidden name=id value="{{$item->id}}">
                <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                <button class="submit" type="submit" >更新</button> 
            </form>
            </div>
        </div>
    @endforeach
    
</body>
</html>