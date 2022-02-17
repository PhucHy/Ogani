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
                            @if(session("adroles_id"))
                            <div class="header__top__right__auth">
                                <a href="{{route('guser')}}"><i class="fa fa-user"></i>Admin page</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="edit-account/{{session('adid')}}"><i class="fa fa-edit"></i>Thông tin tài khoản</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="{{route('glogout')}}"> <i class="fa fa-power-off"></i>Đăng xuất</a>
                            </div>
                            @elseif(session("name"))
                            <div class="header__top__right__auth">
                                <a href="edit-account/{{session('id')}}"><i class="fa fa-user"></i>{{session("name")}}</a>
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
                            @foreach($categories as $data)
                            <li><a href="cat-product/{{$data->categories_id}}"><strong>{{$data->categories_name}}</strong></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="Nhập sản phẩm hoặc giá sản phẩm bạn muốn tìm" id="search" name="search">
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
                        <h2>Tất cả sản phẩm</h2>
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
            $('#search').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('search') }}',
                    data: {
                        'search': $value
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

        <!-- Latest Product Section Begin -->
        <section class="latest-product spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="latest-product__text">
                            <h4>Sản phẩm mới nhất</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    <a href="shop-details/{{$productsMoiNhat[0]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsMoiNhat[0]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsMoiNhat[0]->products_name}}</h6>
                                            <span>{{number_format($productsMoiNhat[0]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsMoiNhat[1]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsMoiNhat[1]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsMoiNhat[1]->products_name}}</h6>
                                            <span>{{number_format($productsMoiNhat[1]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsMoiNhat[2]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsMoiNhat[2]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsMoiNhat[2]->products_name}}</h6>
                                            <span>{{number_format($productsMoiNhat[2]->products_price) }} `VNĐ</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    <a href="shop-details/{{$productsMoiNhat[3]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsMoiNhat[3]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsMoiNhat[3]->products_name}}</h6>
                                            <span>{{number_format($productsMoiNhat[3]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsMoiNhat[4]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsMoiNhat[4]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsMoiNhat[4]->products_name}}</h6>
                                            <span>{{number_format($productsMoiNhat[4]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsMoiNhat[5]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsMoiNhat[5]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsMoiNhat[5]->products_name}}</h6>
                                            <span>{{number_format($productsMoiNhat[5]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="latest-product__text">
                            <h4>Sản phẩm giảm giá</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    <a href="shop-details/{{$productsGiamGia[0]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsGiamGia[0]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsGiamGia[0]->products_name}}</h6>
                                            <span>{{number_format($productsGiamGia[0]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsGiamGia[1]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsGiamGia[1]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsGiamGia[1]->products_name}}</h6>
                                            <span>{{number_format($productsGiamGia[1]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsGiamGia[2]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsGiamGia[2]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsGiamGia[2]->products_name}}</h6>
                                            <span>{{number_format($productsGiamGia[2]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    <a href="shop-details/{{$productsGiamGia[3]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsGiamGia[3]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsGiamGia[3]->products_name}}</h6>
                                            <span>{{number_format($productsGiamGia[3]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsGiamGia[4]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsGiamGia[4]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsGiamGia[4]->products_name}}</h6>
                                            <span>{{number_format($productsGiamGia[4]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsGiamGia[5]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsGiamGia[5]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsGiamGia[5]->products_name}}</h6>
                                            <span>{{number_format($productsGiamGia[5]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="latest-product__text">
                            <h4>Sản phẩm bán chạy</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    <a href="shop-details/{{$productsBanChay[0]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsBanChay[0]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsBanChay[0]->products_name}}</h6>
                                            <span>{{number_format($productsBanChay[0]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsBanChay[1]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsBanChay[1]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsBanChay[1]->products_name}}</h6>
                                            <span>{{number_format($productsBanChay[1]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsBanChay[2]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsBanChay[2]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsBanChay[2]->products_name}}</h6>
                                            <span>{{number_format($productsBanChay[2]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    <a href="shop-details/{{$productsBanChay[3]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsBanChay[3]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsBanChay[3]->products_name}}</h6>
                                            <span>{{number_format($productsBanChay[3]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsBanChay[4]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsBanChay[4]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsBanChay[4]->products_name}}</h6>
                                            <span>{{number_format($productsBanChay[4]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                    <a href="shop-details/{{$productsBanChay[5]->products_id}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/{{$productsBanChay[5]->products_img}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$productsBanChay[5]->products_name}}</h6>
                                            <span>{{number_format($productsBanChay[5]->products_price)}} VNĐ</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Latest Product Section End -->


        @endsection
