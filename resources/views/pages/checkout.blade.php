    @extends('layouts.master')
    @section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Thanh toán</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('ghome')}}">Trang chủ</a>
                            <span>Thanh toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(session("success"))
        <div class="alert alert-success" style="text-align: center;">{{session("success")}}</div>
    @endif

    @if(session("fail"))
        <div class="alert alert-danger" style="text-align: center;">{{ session("fail") }}</div>
    @endif

    @if(session('non-item'))
        <div class="alert alert-danger" style="text-align: center;">{{ session('non-item') }}</div>
    @endif
    


    <!-- Breadcrumb Section End -->
<?php 
    $content=Cart::content();
 ?>
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            
            <div class="checkout__form">

                <h4>Chi tiết đơn hàng</h4>
                <form action="checkout" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Tên người nhận<span>*</span></p>
                                        <input type="text" name="receiver" placeholder="{{$errors->first('receiver')}}" value="{{old('receiver')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Tên người mua<span>*</span></p>
                                        <input type="text" name="buyer" placeholder="{{$errors->first('buyer')}}" value="{{old('buyer')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ người nhận<span>*</span></p>
                                <input type="text" placeholder="{{$errors->first('receiver_address')}}" class="checkout__input__add" name="receiver_address" value="{{old('receiver_address')}}">
                            </div>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" class="checkout__input__add" name="email" value="{{session('email') ? session('email') : session('ademail')}}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>SĐT người nhận<span>*</span></p>
                                        <input type="text" name="receiver_phone" placeholder="{{$errors->first('receiver_phone')}}" value="{{old('receiver_phone')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>SĐT người mua<span>*</span></p>
                                        <input type="text" name="buyer_phone" placeholder="{{$errors->first('buyer_phone')}}" value="{{old('buyer_phone')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Đơn giá</span></div>
                                <ul>
                                    @foreach($content as $data)
                                    <li>{{$data->name}}<span>{{number_format($data->price*$data->qty)}} VNĐ</span></li>
                                    @endforeach
                                </ul>
{{--                                 <div class="checkout__order__subtotal">Subtotal <span>{{Cart::subtotal()}} VNĐ</span></div> --}}
                                <div class="checkout__order__total">Tổng tiền <span>{{Cart::pricetotal()}} VNĐ</span></div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    
    @endsection