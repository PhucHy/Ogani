  <head>
        <meta charset="UTF-8">
        <meta name="description" content="Ogani Template">
        <meta name="keywords" content="Ogani, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="_token" content="{{ csrf_token() }}">
        <base href="{{asset('')}}">
        <title>@yield('title','Ogani')</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="{{asset('/css/signup.css')}}">
    </head>
    <body>

      <form action="{{ route('psignup') }}" method="post">
      @csrf
        <h1>Đăng ký</h1>
        <style>
          ::placeholder{
            color: red;
          }
        </style>
        
        <fieldset>
          <label for="name">Họ tên</label>
          <input type="text" id="name" name="name" placeholder="{{$errors->first('name')}}" value="{{old('name')}}">
          
          <label for="name">Số điện thoại</label>
          <input type="text" id="phone" name="phone" placeholder="{{$errors->first('phone')}}" value="{{old('phone')}}">

          <label for="name">Địa chỉ</label>
          <input type="text" id="address" name="address" placeholder="{{$errors->first('address')}}" value="{{old('address')}}">

          <label for="mail">Email</label>
          <input type="email" id="email" name="email" placeholder="{{$errors->first('email')}}" value="{{old('email')}}">
          
          <label for="password">Mật khẩu</label>
          <input type="password" id="password" name="password" placeholder="{{$errors->first('password')}}">
          
        </fieldset>
        <table style="margin-left: auto; margin-right: auto">
          <tr>
           <td width="50%">
              <div><input type="submit" value="Đăng ký" /></div>
           </td>
           <td width="50%">
            <div><input type="submit" value="Trở về trang chủ" name="home" /></div>
           </td>
        </tr>
        </table>        
      </form>
      
      

    </body>
</html>