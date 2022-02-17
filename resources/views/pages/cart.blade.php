    @extends('layouts.master')
    @section('content')


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Giỏ hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('ghome')}}">Home</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <?php
      $content=Cart::content();
      ?>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($content as $data)
                                <form action="updateCart" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/product/{{$data->options->image}}" alt="">
                                        <h5>{{$data->name}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{number_format($data->price)}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" name="cart_qty" value="{{$data->qty}}" id="product-quanity" max="{{$data->weight}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        {{ number_format($data->qty*$data->price) }} VNĐ
                                    </td>
                                    <td class="shoping__cart__item__retweet">
                                        <input type="submit" value="Cập nhật" name="update_cart" style="color: black; text-decoration: none; display: inline-block; -webkit-transition: none; border: none;">
                                        <input type="hidden" name="rowId_cart" value="{{$data->rowId}}">
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="/deleteCart/{{$data->rowId}}"><span class="icon_close"></span></a>
                                        <input type="hidden" name="rowId_cart" value="{{$data->rowId}}">
                                        
                                    </td>
                                </tr>
                                </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        <div class="home"><a href="{{route('ghome')}}">Trở về trang chủ</a></div>
                        <style>
                            .home a{
                                text-decoration: none;
                                display: inline-block;
                                color: #007bff;
                            }
                        </style>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>{{ Cart::subtotal() }} VNĐ</span></li>
                            <li>Total <span>{{ Cart::priceTotal() }} VNĐ</span></li>
                        </ul>
                        <a href="{{route('gcheckout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    @endsection