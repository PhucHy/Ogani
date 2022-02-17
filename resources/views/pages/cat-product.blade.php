    @extends('layouts.masterSearch')
    @section('content')

    <!-- Page Preloder -->
    <head>
        <meta name="_token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href=""><i class="fa fa-user"></i>

                </a>
            </div>
            <div class="header__top__right__auth">
                <a href="{{route('glogin')}}"><i class="fa fa-user"></i>
                </a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{route('ghome')}}">Home</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="{{route('gshopdetails')}}">Shop Details</a></li>
                        <li><a href="cart">Shoping Cart</a></li>
                        <li><a href="{{route('gcheckout')}}">Check Out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> CD51806147@student.stu.edu.vn</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            @if(session("roles_id"))
                            <div class="header__top__right__auth">
                                <a href="{{route('gadmin')}}"><i class="fa fa-user"></i>Admin page</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="{{route('glogout')}}"> <i class="fa fa-power-off"></i>Đăng xuất</a>
                            </div>
                            @elseif(session("name"))
                            <div class="header__top__right__auth">
                                <a href=""><i class="fa fa-user"></i>{{session("name")}}</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="{{route('glogout')}}"> <i class="fa fa-power-off"></i>Đăng xuất</a>
                            </div>
                            @else
                            <div class="header__top__right__auth">
                                <a href="{{route('gsignup')}}"><i class="fa fa-user"></i>Đăng ký</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="{{route('glogin')}}"><i class="fa fa-user"></i>Đăng nhập</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(session("message"))
        <div class="alert alert-success" style="text-align: center;">
            {{ session("message") }}
        </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{route('ghome')}}"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="{{route('ghome')}}">Trang chủ</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Tất cả danh mục</span>
                        </div>
                        <ul>
                            @foreach($categoriesAll as $data)
                            <li><a href="cat-product/{{$data->categories_id}}"><strong>{{$data->categories_name}}</strong></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="Nhập sản phẩm hoặc giá sản phẩm bạn muốn tìm" id="searchCategories" name="searchCategories">
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+84 932 761 318</h5>
                                <span>Hỗ trợ 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Hero Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>{{$categories[0]->categories_name}}</h2>
                        <form method="post" action="">
                            @csrf
                            <div class="pull-right">
                                <select onchange="submit()" name="orderBy">
                                    <option value="md" selected>Mặc định</option>
                                    <option value="1">Mới nhất</option>
                                    <option value="2">Giá tăng dần</option>
                                    <option value="3">Giá giảm dần</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row featured__filter" id="tk">
                @if($products)
                    @foreach($products as $data)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="img/product/{{$data->products_img}}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="shop-details/{{$data->products_id}}"><i class="fa fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="shop-details/{{$data->products_id}}">{{$data->products_name}}</a></h6>
                                <h5>{{number_format($data->products_price)}} VNĐ</h5>
                            </div>
                    </div>
                </div>
                    @endforeach
                @endif
            </div>
        </section>

        <!-- Featured Section End -->
        <script type="text/javascript">
            $('#searchCategories').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('cat-product/'.$categories[0]->categories_id.'/searchCategories') }}',
                    data: {
                        'searchCategories': $value
                    },
                    success:function(data){
                        $('#tk').html(data);
                    }
                });
            })
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
        <!-- Banner Begin -->
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="img/banner/banner-1.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="img/banner/banner-2.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner End -->


        @endsection
