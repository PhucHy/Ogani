<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearchController extends Controller
{
    //Tìm kiếm trang chủ
	public function search(Request $request)
    {
        if($request->ajax()) {
            $output = '';
            $products = DB::table('products')
            ->join('categories','categories.categories_id','=','products.categories_id')
            ->where('products_name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('products_price', 'LIKE', '%' . $request->search . '%')
            ->orWhere('categories.categories_name', 'LIKE', '%' . $request->search . '%')
            ->get();
            if($products) {
                foreach ($products as $key => $product) {
                    $output .= '
                    <div class="col-lg-3 col-md-4 col-sm-6" id="tk">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="img/product/'.$product->products_img.'" style="background-image: url(img/product/'.$product->products_img.');">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="shop-details/'.$product->products_id.'"><i class="fa fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="shop-details/'.$product->products_id.'">'.$product->products_name.'</a></h6>
                                <h5>'.number_format($product->products_price).' VNĐ</h5>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } 
            return Response($output);
        }
    }

    //Tìm kiếm theo danh mục
    public function searchCategories(Request $request)
    {
        if($request->ajax()) {
            $output = '';
            $products = DB::table('products')
            ->join('categories','categories.categories_id','=','products.categories_id')
            ->where('products.categories_id',$request->categories_id)
            ->where('products_name', 'LIKE', '%' . $request->searchCategories . '%')
            ->orWhere('products_price', 'LIKE', '%' . $request->searchCategories . '%')
            ->get();
            if($products) {
                foreach ($products as $key => $product) {
                    $output .= '
                    <div class="col-lg-3 col-md-4 col-sm-6" id="tk">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="img/product/'.$product->products_img.'" style="background-image: url(img/product/'.$product->products_img.');">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="shop-details/'.$product->products_id.'"><i class="fa fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="shop-details/'.$product->products_id.'">'.$product->products_name.'</a></h6>
                                <h5>'.number_format($product->products_price).' VNĐ</h5>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } 
            return Response($output);
        }
    }
    //Admin
}
