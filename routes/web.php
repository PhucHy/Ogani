<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LiveSearchController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Trang chủ
Route::get("/", [HomeController::class, "showProducts"])->name("ghome");
Route::post("/", [HomeController::class, "orderProduct"])->name("phome");
Route::get("/search", [LiveSearchController::class, "search"]);

//Danh mục sản phẩm
Route::get("cat-product/{categories_id}", [HomeController::class, "showCatProduct"])->name("gcatproduct");
Route::post("cat-product/{categories_id}", [HomeController::class, "orderProductCat"]);
Route::get("cat-product/{categories_id}/searchCategories", [LiveSearchController::class, "searchCategories"]);

//Đăng ký
Route::get('signup', [AuthController::class, 'getRegister'])->name("gsignup");
Route::post('signup', [AuthController::class, 'postRegister'])->name("psignup");

//Đăng nhập và đăng xuất
Route::get("login", [AuthController::class, "getLogin"])->name("glogin");
Route::post("login", [AuthController::class, "postLogin"])->name("plogin");
Route::get("logout", [AuthController::class, "Logout"])->name("glogout");

//Sửa thông tin
Route::get("edit-account/{id}",[AuthController::class,"getEdit"])->name("gedit");
Route::post("edit-account/{id}", [AuthController::class, "postEdit"])->name("pedit");

//Thanh toán
Route::get("checkout", [CartController::class, "getCheckout"])->name("gcheckout");
Route::post("checkout", [CartController::class, "checkOut"]);

//Chi tiết sản phẩm 
Route::get('shop-details', [HomeController::class, 'getShopdetails'])->name("gshopdetails");
Route::get("shop-details/{products_id}", [HomeController::class, "showProductDetails"])->name("product_detail");
Route::post("shop-details/{products_id}", [HomeController::class, "postComment"])->name("pcomment");

//Giỏ hàng
Route::post("cart", [CartController::class, "addtoCart"]);
Route::get("cart", [CartController::class, "showCart"]);
Route::get("deleteCart/{rowId}", [CartController::class, "deleteCart"]);
Route::post("updateCart", [CartController::class, "updateCart"]);


//Admin
Route::get("index", [AdminController::class, "Adminpage"])->name("gadmin");
Route::post("index", [AdminController::class, "postLoginAdmin"])->name("padmin");
Route::get("index/logout", [AdminController::class, "LogoutAdmin"])->name("gadlogout");

//Quản lý user
Route::get("user", [AdminController::class, "displayUser"])->name("guser");
Route::get("user/{id}", [AdminController::class, "getDeleteUser"]);
Route::post("user", [AdminController::class, "postRegisterAdmin"])->name("pAdminSignup");

//Quản lý sản phẩm
Route::get("products", [AdminController::class, "displayProduct"])->name("gProductAdmin");
Route::get("products/timkiem", [AdminController::class, "timkiem"]);
Route::get("products/{products_id}", [AdminController::class, "getDeleteProduct"]);
Route::post("products", [AdminController::class, "postNewProduct" ])->name("pNewProduct");
Route::get("editProduct/{products_id}", [AdminController::class, "getEditProduct"]);
Route::post("editProduct/{products_id}", [AdminController::class, "postEditProduct"]);


//Quản lý đơn hàng
Route::get("order", [AdminController::class, "displayOrder"])->name("gOrderAdmin");
Route::get("order/Xoa/{order_id}", [AdminController::class, "getDeleteOrder"]);
Route::get("order/{order_id}",[AdminController::class,"getDuyetDH"]);

Route::get("orderdetail/{order_id}", [AdminController::class, "displayOrderdetail"])->name("gOrderdetailAdmin");

//Quản lý bình luận
Route::get("comment", [AdminController::class, "displayComment"])->name("gCommentAdmin");
Route::get("comment/Xoa/{comment_id}", [AdminController::class, "getDeleteComment"]);
Route::get("comment/{comment_id}",[AdminController::class,"getDuyetBL"]);

//Quản lý danh mục
Route::get("categories", [AdminController::class, "displayCategories"])->name("gCategoriesAdmin");
Route::get("categories/timkiem", [AdminController::class, "timkiem"]);
Route::get("categories/{categories_id}", [AdminController::class, "getDeleteCategories"]);
Route::post("categories", [AdminController::class, "postNewCategories" ])->name("pNewCategories");
Route::get("editCategories/{categories_id}", [AdminController::class, "getEditCategories"]);
Route::post("editCategories/{categories_id}", [AdminController::class, "postEditCategories"]);