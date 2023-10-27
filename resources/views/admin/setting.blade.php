<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NagasakiSasebo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/base.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  </head>
  <body>
    <header class="header">
        @include('header')
    </header>

    <p class="page_title">管理画面</p>
    
    <div class="setting">
        <div class="block">
            <div class="info">
                <div class=setting_pic><a href="{{ url('/admin/items') }}"><img src="{{asset('img/item.png')}}" alt="商品管理"></a></div>
                <div class="theme" style="padding-top:15px;">
                        <a>商品管理</a>
                </div>
            </div>
            <div class="info">
            <div class=setting_pic><a href="{{ url('/admin/orders') }}"><img src="{{asset('img/order.png')}}" alt="注文管理" ></div>
                <div class="theme" style="padding-top:15px;">
                        <a>注文管理</a>
                </div>
            </div>
            <div class="info">
                <div class=setting_pic><a href="{{ url('/admin/users') }}"><img src="{{asset('img/user.png')}}" alt="会員管理" ></div>
                <div class="theme" style="padding-top:15px;">
                        <a>会員管理</a>
                </div>
            </div>
            <div class="info">
                <div class=setting_pic><a href="{{ url('/admin/contacts') }}"><img src="{{asset('img/contact.png')}}" alt="問合管理" ></div>
                <div class="theme" style="padding-top:15px;">
                        <a>問合管理</a>
                </div>
            </div>
        </div>
    </div>

  </body>
</html>