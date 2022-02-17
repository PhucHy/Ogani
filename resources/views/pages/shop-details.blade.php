    @extends('layouts.master')
    @section('content')
    
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}" >
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{$products[0]->products_name}}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('ghome')}}">Trang chủ</a>
                            <span>{{$products[0]->products_name}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                            src="img/product/{{$products[0]->products_img}}" alt="">
                        </div>
                        <!-- <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/product/details/product-details-2.jpg"
                                src="img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                src="img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                src="img/product/details/thumb-4.jpg" alt="">
                            </div> -->
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__text">
                            <h3>{{$products[0]->products_name}}</h3>
                            <div class="product__details__price">{{ number_format($products[0]->products_price)}} VNĐ</div>
                            <p>{{$products[0]->products_description}}</p>
                            <form action="cart" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="product__details__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="number" value="1" min="1" step="1" name="qty" id="product-quanity" max="{{$products[0]->products_qty}}">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="products_id" value="{{$products[0]->products_id}}">
                                <a href="cart/{{$products[0]->products_id}}"><button type="submit" class="primary-btn" name="submit">Thêm vào giỏ hàng</button></a>
                                <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="content-item" id="comments">
            @if(session('binhluan'))
            <div class="alert alert-success" style="text-align: center;">{{session('binhluan')}}</div>
            @endif
            @if(session('thatbai'))
            <div class="alert alert-danger" style="text-align: center;">{{session('thatbai')}}</div>
            @endif
            <div class="container">   
                <div class="row">
                    <div class="col-sm-8">   
                        <form action="" method="post">
                            @csrf
                            <h3 class="pull-left">Bình luận</h3>
                            <fieldset>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                        <textarea class="form-control" id="message" placeholder="Bình luận của bạn" name="comment"></textarea>
                                    </div>
                                </div>      
                            </fieldset>
                            <button type="submit" class="btn btn-normal">Đăng bình luận</button>
                        </form>

                        <h3>{{$comment->count()}} Bình luận</h3>

                        <!-- COMMENT 1 - START -->
                        @foreach($comment as $data)
                        <div class="media">
                            <a class="pull-left" href="#"></a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$data->name}}</h4>
                                <p>{{$data->comment}}</p>
                                <ul class="list-unstyled list-inline media-detail pull-left">
                                    <li><i class="fa fa-calendar"></i>{{$data->created_at->format('d/m/Y')}}</li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        <!-- COMMENT 1 - END -->         
                    </div>
                </div>
            </div>
        </section>

        @endsection