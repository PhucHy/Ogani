<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield("title","Ogani Admin")</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- Favicon icon -->
	<link rel="icon" href="{{asset(('/admin/images/favicon.ico'))}}" type="image/x-icon">
	<!-- fontawesome icon -->

	<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}" type="text/css">


</head>
	
<body>

	<link rel="stylesheet" href="{{asset('admin/css/login.css')}}">
    <div class="container">

        @if(session("message"))
            <div class="alert alert-success" style="text-align: center;">
                {{ session("message") }}
            </div>
        @endif

        @if(session("alert"))
            <div class="alert alert-danger" style="text-align: center;">
                {{ session("alert") }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    ADMIN PANEL
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="post" action="{{route('padmin')}}">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="{{$errors->first('email') ? $errors->first('email') : session('nouser')}}" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Mật khẩu</label>
                                <input type="password" class="form-control" name="password" placeholder="{{$errors->first('password') ? $errors->first('password') : session('wrongpass')}}">
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary">Đăng nhập</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
	
</body>
</html>
<link rel="stylesheet" href="">
