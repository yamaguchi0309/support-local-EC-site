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
        <p class="page_title">編集内容確認</p>
        <div class="post">
            <div class="folm_bl">
                <a>下記の内容を確認して、【登録】<br>内容を訂正する場合は【戻る】</a>
            </div>
            
            <form action="{{ url('/admin/items/edit_complete') }}" method="POST">
                @csrf 

                <input type="hidden" name="id" value="{{$item_data['id']}}">
                <input type="hidden" name="Name" value="{{$item_data['Name']}}">
                <input type="hidden" name="Description" value="{{$item_data['Description']}}">
                <input type="hidden" name="Price" value="{{$item_data['Price']}}">
                <input type="hidden" name="Tax" value="{{$item_data['Tax']}}">
                <input type="hidden" name="Stock" value="{{$item_data['Stock']}}">
                <input type="hidden" name="Is_selling" value="{{$item_data['Is_selling']}}">
                <input type="hidden" name="Item_img" value="{{$item_data['Item_img']}}">
                
                <?php
                    if($item_data['Is_selling'] === "0"){
                        $Is_selling = "停止";
                    }else{
                        $Is_selling = "販売";
                    }
                ?>

                <p>商品名</p>
                    <td>{{$item_data['Name']}}</td>
                <p>商品説明</p>
                    <td>{{$item_data['Description']}}</td>            
                <p>単価</p>
                    <td>{{$item_data['Price']}}</td>
                <p>税率</p>
                    <td>{{$item_data['Tax']}}</td>            
                <p>在庫</p>
                    <td>{{$item_data['Stock']}}</td>
                <p>販売状況</p>
                    <td>{{$Is_selling}}</td>           
                <p>商品画像</p>
                    <td>{{$item_data['Item_img']}}</td>
                <p>メモ</p>
                    <td>{{$item_data['Memo']}}</td>  

                <div class="confirm_btn">
                    <button class="back_btn" type="button" onclick="history.back(-1)">戻る</button>
                    <button class="submit" type="submit" >登録</button> 
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