<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Models\User;
use App\Models\Users;
use App\Cart;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $products = DB::table("products")->get();
        return view("pages.index", compact("products"));
    }

    // public function test()
    // {
    //     $products = DB::table("products")->get();
    //     return view("welcome", compact("products"));
    // }

    public function getShopdetails()
    {
    	return view("pages.shop-details");
    }

    public function getSignup()
    {
    	return view("pages.signup");
    }

    public function showProducts(Request $req)
    {
        $products = Products::orderBy("products_id","DESC")
        ->where('status_id','=',1)
        ->orWhere('status_id','=',6)
        ->orWhere('status_id','=',7)
        ->orWhere('status_id','=',8)
        ->get();
        $productsGiamGia = Products::join('status','status.status_id','=','products.status_id')
        ->where('status.status_id','=',8)
        ->paginate(6);
        $productsBanChay = Products::join('status','status.status_id','=','products.status_id')
        ->where('status.status_id','=',6)
        ->paginate(6);
        $productsMoiNhat = Products::orderBy("created_at","DESC")->paginate(6);
        return view("pages.index",compact("products","productsMoiNhat","productsBanChay","productsGiamGia"));
        
    }

    public function showProductDetails(Request $req)
    {
        $products = Products::where("products_id",$req->products_id)->get();
        $comment = Comment::join('users','users.id','=','comment.id')
        ->join('status','status.status_id','=','comment.status_id')
        ->select('users.name','comment.*','status.status_id')
        ->where('products_id',$req->products_id)
        ->where('comment.status_id','=', 3)
        ->orderBy('comment.created_at','ASC')
        ->paginate(4);
        return view("pages.shop-details",compact("products","comment"));
    }

    public function showCategories()
    {
        $categories = Products::orderBy("categories_name","ASC")->get();
        return view("pages.index")->with('categories',$categories);
    }

    public function postComment(Request $req, $products_id)
    {
        if(session('email') || session('ademail'))
        {
            $product = $products_id;
            $products = Products::where('products_id', $product)->get();
            $cmt = new comment;
            $cmt->products_id = $product;
            $cmt->comment = $req->comment;
            $cmt->status_id = 4;
            $cmt->id = session('id');
            $cmt->save();
            return redirect('shop-details/'.$product)->with('binhluan', 'Đăng bình luận thành công');
        } else {
            $product = $products_id;
            $products = Products::where('products_id', $product)->get();
            return redirect('shop-details/'.$product)->with('thatbai', 'Bạn phải đăng nhập để đăng bình luận');
        }
    }
    
    public function showCatProduct(Request $req, $categories_id)
    {
        $categoriesAll = Categories::all();
        $categories = Categories::where('categories_id', $req->categories_id)->get();
        $products = Products::join('categories','categories.categories_id','=','products.categories_id')
        ->select('products.*','categories.categories_name')
        ->where('products.categories_id',$req->categories_id)
        ->orderBy('products.products_id','ASC')
        ->get();
        return view("pages.cat-product",compact('categoriesAll','categories','products'));
    }

    public function orderProduct(Request $req)
    {
        $productsGiamGia = Products::join('status','status.status_id','=','products.status_id')
        ->where('status.status_id','=',8)
        ->paginate(6);
        $productsBanChay = Products::join('status','status.status_id','=','products.status_id')
        ->where('status.status_id','=',6)
        ->paginate(6);
        $productsMoiNhat = Products::orderBy("created_at","DESC")->paginate(6);
        if($req->orderBy){
            switch($req->orderBy){
                case 1:
                    $products = Products::orderBy('created_at','desc')
                    ->where('status_id','=',1)
                    ->orWhere('status_id','=',6)
                    ->orWhere('status_id','=',7)
                    ->orWhere('status_id','=',8)
                    ->get();
                    break;
                case 2:
                    $products = Products::orderBy('products_price','asc')
                    ->where('status_id','=',1)
                    ->orWhere('status_id','=',6)
                    ->orWhere('status_id','=',7)
                    ->orWhere('status_id','=',8)
                    ->get();
                    break;
                case 3:
                    $products = Products::orderBy('products_price','desc')
                    ->where('status_id','=',1)
                    ->orWhere('status_id','=',6)
                    ->orWhere('status_id','=',7)
                    ->orWhere('status_id','=',8)
                    ->get();
                    break;
                default:
                    $products = Products::orderBy('created_at','desc')
                    ->where('status_id','=',1)
                    ->orWhere('status_id','=',6)
                    ->orWhere('status_id','=',7)
                    ->orWhere('status_id','=',8)
                    ->get();
            }
            return view("pages.index",compact("products","productsMoiNhat","productsBanChay","productsGiamGia"));
        }
    }

    public function orderProductCat(Request $req, $categories_id)
    {
        $categoriesAll = Categories::all();
        $categories = Categories::where('categories_id', $req->categories_id)->get();
        if($req->orderBy){
            switch($req->orderBy){
                case 1:
                    $products = Products::join('categories','categories.categories_id','=','products.categories_id')
                    ->select('products.*','categories.categories_name')
                    ->where('products.categories_id',$req->categories_id)
                    ->orderBy('created_at','desc')
                    ->get();
                    break;
                case 2:
                    $products = Products::join('categories','categories.categories_id','=','products.categories_id')
                    ->select('products.*','categories.categories_name')
                    ->where('products.categories_id',$req->categories_id)
                    ->orderBy('products_price','asc')
                    ->get();
                    break;
                case 3:
                    $products = Products::join('categories','categories.categories_id','=','products.categories_id')
                    ->select('products.*','categories.categories_name')
                    ->where('products.categories_id',$req->categories_id)
                    ->orderBy('products_price','desc')
                    ->get();
                    break;
                default:
                    $products = Products::join('categories','categories.categories_id','=','products.categories_id')
                    ->select('products.*','categories.categories_name')
                    ->where('products.categories_id',$req->categories_id)
                    ->orderBy('created_at','desc')
                    ->get();
            }
            return view("pages.cat-product",compact('categoriesAll','categories','products'));
        }
    }
}
