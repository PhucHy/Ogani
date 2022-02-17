<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <base href="{{asset('')}}">
    <title>@yield('title','Ogani')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}" >
</head>
<body>
  
    @if(session("success"))
        <div class="alert alert-success" style="text-align: center;">
            {{ session("success") }}
        </div>
    @endif

    @if(session("non-user"))
        <div class="alert alert-danger" style="text-align: center;">
            {{ session("non-user") }}
        </div>
    @endif
    
    <!-- @if($errors->any())
        <div class="alert alert-danger" style="text-align: center;">
            @foreach($errors->all() as $error)
                {{$error}} <br/>
            @endforeach
        </div>
    @endif -->

<div class="login-page">
  <div class="form">
    <form class="login-form" method="post">
        @csrf
        <input type="text" placeholder="Nhập email" name="email" value="{{old('email')}}" />
        @if($errors->first('email'))
        <font color="red" />{{ $errors->first("email") }}
        @elseif(session('nouser'))
        <font color="red" />{{ session("nouser") }}
        @endif

        <input type="password" placeholder="Nhập mật khẩu" name="password" />
        @if($errors->first('password'))
        <font color="red" />{{ $errors->first("password") }}
        @elseif(session("wrongpass"))
        <font color="red" />{{session("wrongpass")}}
        @endif
        <table style="margin-left: auto; margin-right: auto">
          <tr>
           <td width="50%">
              <div><input type="submit" value="Đăng nhập" name="login" /></div>
           </td>
           <td width="50%">
            <div><input type="submit" value="Trở về trang chủ" name="home" /></div>
           </td>
        </tr>
        </table> 
    </form>
  </div>
</div>
</body>
</html>



