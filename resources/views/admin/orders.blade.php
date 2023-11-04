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
    <div class="back_setting">
      <a href="{{ url('/admin/setting') }}">管理画面に戻る</a>
    </div>

    <!-- データベースに登録されている内容を表示 -->
    <div class="admin_main">
    <p class="page_title">注文一覧</p>
    <!-- 検索機能ここから -->
    <div style="display:flex;flex-wrap: wrap;justify-content: center; margin-bottom:20px;">
        <form action="{{ route('admin.search.orders') }}" method="GET" style=" text-align: center; width:70%;">
        @csrf
          <input type="text" name="keyword" value="{{ $keyword }}" style=" width:60%;">
          <input type="submit" value="検索" style="width:50px;">
        </form>
    </div>
    <div class="post">
      <table class="admin_table">
      <tr><th>注文番号</th><th>注文日</th><th>お支払い金額</th><th>お支払い方法</th><th>お支払い状況</th><th>注文状況</th><th>配送状況</th></tr>
          @foreach($order_data as $order)
            <!-- お支払い金額（金額＋送料） -->
            @php  $total_amount = $order->amount + $order->postage; @endphp

            <!-- お支払い方法 -->
            @php
            if($order->payment_method === "0"){
              $Payment_method = "クレジットカード";
            }elseif($order->payment_method === "1"){
              $Payment_method = "銀行振込";
            }
            @endphp

            <!-- お支払い方法 -->
            @php
            if($order->payment_status === "0"){
              $Payment_status = "受付済";
            }elseif($order->payment_status === "1"){
              $Payment_status = "完了";
            }
            @endphp

            <!-- 注文状況 -->
            @php
            if($order->order_status === "0"){
              $Order_status = "ご入金待";
            }elseif($order->order_status === "1"){
              $Order_status = "受領済";
            }elseif($order->order_status === "2"){
              $Order_status = "取消済";
            }
            @endphp
            
            <!-- 配送状況 -->
            @php
            if($order->order_status === "2"){
              $Shipping_status = "注文取消";
            }elseif($order->shipping_status === "0"){
              $Shipping_status = "準備中";
            }elseif($order->shipping_status === "1"){
              $Shipping_status = "発送済";
            }elseif($order->shipping_status === "2"){
              $Shipping_status = "配達済";
            }
            @endphp
                       
            <tr>
            <td>{{$order->order_num}}</td>
            <td style="width:16%;">{{$order->created_at}}</td>
            <td style="width:12%;text-align:right;">{{number_format($total_amount)}}円</td>
            <td style="width:16%;">{{$Payment_method}}</td>
            <td style="width:8%;">{{$Payment_status}}</td>
            <td style="width:8%;">{{$Order_status}}</td>
            <td style="width:8%;">{{$Shipping_status}}</td>       									
        
            <!--  詳細ボタン -->
            <td style="width:8%;"><button style="width:100%;" onclick="location.href='{{ route('admin.orders.detail', ['id'=>$order->id]) }}'">詳細</button>
            <!-- <button class="back_btn" type="button" onclick="location.href='{{ route('admin.orders.detail', ['id'=>$order->id]) }}' ">詳細</button> -->
            </td>

            
            </tr>
          @endforeach
    </table>
    <div class="pagination">
        {{ $order_data->links('pagination::bootstrap-4') }}
    </div>
    </div>
  </div>

  </body>
</html>