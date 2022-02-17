<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use App\Models\order;
use App\Models\orderdetail;
use App\Models\Products;
use App\Models\Comment;
use App\Models\Status;
use App\Models\Categories;
use Hash;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminController extends Controller
{

    //Admin Control
    public function postLoginAdmin(Request $request)
    {
        $this->validate($request,[
            "email"     =>  "required|email:rfc,dns|ends_with:gmail.com,hotmail.com,yahoo.com",
            "password"  =>  "required|min:5|max:18"
        ],[
            "email.ends_with"    => "Email phải là gmail hoặc hotmail",
            "email.required"     => "Hãy điền email",
            "email.email"        => "Email không đúng định dạng",
            "password.min"       => "Mật khẩu không được ít hơn 5 ký tự",
            "password.max"       => "Mật khẩu không được nhiều hơn 18 ký tự",
            "password.required"  => "Hãy điền mật khẩu"
        ]);

        $user = new user;
        $user= user::where("email","=",$request->email)->first();
        if($user != null)
        {
            $username = $user->name;
            $role = $user->roles_id;
            $email = $user->email;
            $id = $user->id;
            if(Hash::check($request->password,$user->pass))
            {
                if($user->roles_id == 1)
                {
                    session(['adid'=>$id]);
                    session(["ademail"=>$email]);
                    session(['adname'=>$username]);
                    session(["adroles_id"=>$role]);
                    return redirect("user")->with("message","Đăng nhập thành công");
                } elseif($user->roles_id == 2) {
                    return redirect()->back()->withInput()->with("alert","Bạn không có quyền truy cập trang này");    
                }
            } else
                return redirect()->back()->with("alert","Mật khẩu không đúng");
        }
        else
            return redirect()->back()->withInput()->with("alert","Tài khoản chưa đăng ký");
    }

    public function LogoutAdmin(Request $request)
    {   
        $request->session()->forget("adname");
        $request->session()->forget("adroles_id");
        $request->session()->forget("ademail");
        return redirect("index")->with("message","Đăng xuất thành công");
    }

    public function Adminpage()
    {
        if(session('ademail'))
        {
            return redirect('user');
        } else {
            return view('admin.index');
        }
    }

    //Người dùng
    public function displayUser()
    {
        if(session('ademail'))
        {
            $roles = DB::table('roles')->get();
            $user = Users::orderBy("id","ASC")
            ->join('roles','roles.roles_id','=','users.roles_id')
            ->get();
            return view("admin.user",compact('user','roles'));
        } else {
            return redirect("index")->with("alert","Bạn không có quyền truy cập trang này");
        }
    }

    public function postRegisterAdmin(Request $request)
    {
        if($request->them)
        {
            $this->validate($request,
                [
                    "email"     => "required|email:rfc,dns|unique:users,email|ends_with:gmail.com,hotmail.com,yahoo.com",
                    "password"  => "required|min:5|max:18",
                    "name"      => "required|regex:/[a-zA-Z\- ]+/i",
                    "address"   => "required",
                    "phone"     => "required|numeric",
                    "roles_id"  => "required",
                ],[
                    "email.email"       =>  "Email không đúng định dạng",
                    "email.required"    =>  "Bạn chưa nhập email",
                    "email.ends_with"   =>  "Email phải là gmail hoặc hotmail",
                    "roles_id.required" =>  "Hãy chọn chức vụ",
                    "password.required" =>  "Hãy điền mật khẩu",
                    "password.min"      =>  "Mật khẩu không được ít hơn 5 ký tự",
                    "password.max"      =>  "Mật khẩu không được nhiều hơn 18 ký tự",
                    "name.required"     =>  "Hãy điền họ tên",
                    "phone.required"    =>  "Hãy điền số điện thoại",
                    "address.required"  =>  "Hãy điền địa chỉ",
                    "email.unique"      =>  "Email này đã tồn tại",
                    "phone.numeric"     =>  "SĐT phải là số",
                    
                    "name.regex"        =>  "Tên người dùng chỉ được chứa ký tự"
                ]);
                    $user = new user;
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->phone = $request->phone;
                    $user->roles_id = $request->roles_id;
                    $user->pass = hash::make($request->password);
                    $user->address = $request->address;
                    $user->save();
                    if(!$user->save()){
                        return redirect()->back()->withInput()->with("alert","Có lỗi xảy ra");
                    } else{
                        return redirect('user')->with("message","Tạo tài khoản admin thành công");
                    }
                    
        } else {
            //dd($request->roles_id,$request->hiddenInput,session('adid'));
            $user = Users::where('id',$request->hiddenInput)
            ->update(['roles_id' => $request->roles_id]);
            if($request->hiddenInput == session('adid') && $request->roles_id == 2)
            {
                $request->session()->forget("adname");
                $request->session()->forget("adroles_id");
                $request->session()->forget("ademail");
                $request->session()->forget("adid");
                return redirect("index")->with('message','Thay đổi quyền người dùng thành công');
            } else {
                return redirect("user")->with('message','Thay đổi quyền người dùng thành công');
            }
        }
    }

    public function getDeleteUser(Request $req)
    {   
        $user = user::where("id",$req->id);
        if($req->id == session('adid'))
        {
            $req->session()->forget("adname");
            $req->session()->forget("adroles_id");
            $req->session()->forget("ademail");
            $req->session()->forget("adid");
            $user->delete();
            return redirect("index")->with("alert","Tài khoản của bạn đã bị xóa");
        } else{
            $user->delete();
            return redirect("user")->with("message","Xóa thành công");
        }
    } 

    //Bình luận
    public function displayComment()
    {
        if(session('ademail'))
        {
            $cmt = Comment::displayComment();
            return view("admin.comment")->with("cmt", $cmt);
        } else {
            return redirect("index")->with("alert","Bạn không có quyền truy cập trang này");
        }
    }

    public function getDuyetBL(Request $req)
    {
        $comment_id = Comment::where('comment_id',$req->comment_id)
        ->update(['status_id' => 3]);
        return redirect('comment')->with('message','Duyệt bình luận thành công');
    }

    public function getDeleteComment(Request $req)
    {
        $cmt = Comment::where("comment_id",$req->comment_id);
        $cmt->delete();
        return redirect("comment")->with("message","Xóa thành công");
    }

    //Đơn hàng
    public function displayOrder()
    {
        if(session('ademail'))
        {
            $order = order::displayOrder();
            return view("admin.order")->with("order",$order);
        } else {
            return redirect("index")->with("alert","Bạn không có quyền truy cập trang này");
        }
    }

    public function getDuyetDH(Request $req)
    {
        $order_id = order::where('order_id',$req->order_id)
        ->update(['status_id' => 3]);
        return redirect('order')->with('message','Duyệt đơn hàng thành công');
    }

    public function getDeleteOrder(Request $req)
    {
        $order= order::where("order_id",$req->order_id);
        $order->delete();
        return redirect("order")->with("message","Xóa thành công");
    }

    //Chi tiết đơn hàng
    public function displayOrderdetail(Request $req)
    {
        if(session('ademail'))
        {
            $order_id = DB::table('order')
            ->join("users","order.email","=","users.email")
            ->join("orderdetail","orderdetail.order_id","=","order.order_id")
            ->select("order.*","users.email","orderdetail.*")
            ->where("order.order_id",$req->order_id)
            ->get();
            return view("admin.orderdetail")->with("order_id", $order_id);
        } else {
            return redirect("index")->with("alert","Bạn không có quyền truy cập trang này");
        }
    }

    public function timkiem(Request $request)
    {
        if($request->ajax()) {
            $status = Status::all();
            $output = '';
            $product = DB::table('products')
            ->join('categories','categories.categories_id','=','products.categories_id')
            ->join('status','status.status_id','=','products.status_id')
            ->select('categories.categories_id','categories.categories_name','products.*','status.status_name')
            ->where('products_name', 'LIKE', '%' . $request->timkiem . '%')
            ->orWhere('products_price', 'LIKE', '%' . $request->timkiem . '%')
            ->get();
            if($product)
            {
                foreach ($product as $key => $products)
                {
                    $output .='
                    <tr>
                        <td>
                            <a href="products/'.$products->products_id.'">Xóa</a>
                        </td>
                            <td>
                                #
                            </td>
                            <td>
                                '.$products->products_name.'
                            </td>
                            <td>
                                '.number_format($products->products_price).'
                            </td>
                            <td>
                                '.$products->products_qty.'
                            </td>
                            <td>
                                '.$products->products_img.'
                            </td>
                            <td>
                                '.$products->categories_name.'
                            </td>
                            <td>
                                '.date('d/m/Y', strtotime($products->expiry_day)).'
                            </td>
                            <td>
                                '.$products->status_name.'
                            </td>
                        </tr>
                    ';
                }
            }
        }
            return Response($output);
    }

    //Danh mục
    public function displayCategories(Request $req)
    {
        if(session('ademail'))
        {
            $categories = Categories::all();
            return view("admin.categories", compact("categories"));
        } else {
            return redirect("index")->with("alert","Bạn không có quyền truy cập trang này");
        }
    }

    public function postNewCategories(Request $req)
    {
        $this->validate($req,[
            "categories_id" => "required",
            "categories_name" => "required",
        ],[
            "categories_id.required" => "Hãy nhập mã danh mục",
            "categories_name.required" => "Hãy nhập tên danh mục"
        ]);
        $categories = new categories;
        $categories->categories_id=$req->categories_id;
        $categories->categories_name=$req->categories_name;
        $categories->save();
        if(!$categories->save()){
            return redirect()->back()->withInput()->with("alert","Có lỗi xảy ra");
        } else{
            return redirect("categories")->with("message","Thêm thành công");
        }
    }

    public function getDeleteCategories(Request $req)
    {
        $categories = Categories::where("categories_id",$req->categories_id);
        $products = Products::join('categories','categories.categories_id','=','products.categories_id')
        ->select('products.*','categories.*')
        ->where('products.categories_id', '=' ,$req->categories_id)
        ->count();
        if($products == 0)
        {
            $categories->delete();
            return redirect("categories")->with("message","Xóa thành công");
        } else {
            return redirect("categories")->with("alert","Không thể xóa khi có sản phẩm trong danh mục");
        }
    }

    public function getEditCategories(Request $req)
    {
        $categories = Categories::where('categories_id',$req->categories_id)
        ->first();
        return view('admin.editCategories',compact('categories'));
    }

    public function postEditCategories(Request $req, $categories_id)
    {
        $categories = Categories::where('categories_id',$categories_id)->first();
        $this->validate($req,[
            "categories_id" => "required",
            "categories_name" => "required",
        ],[
            "categories_id.required" => "Hãy nhập mã danh mục",
            "categories_name.required" => "Hãy nhập tên danh mục"
        ]);
        $categories->categories_id = $req->categories_id;
        $categories->categories_name = $req->categories_name;
        $categories->save();
        if(!$categories->save()){
            return redirect()->back()->withInput()->with("alert","Có lỗi xảy ra");
        } else{
            return redirect("categories")->with("message","Sửa thành công");
        }
    }

    //Sản phẩm
    public function displayProduct(Request $req)
    {
        if(session('ademail'))
        {
            $status = Status::all();
            $product = Products::join("status","status.status_id","=","products.status_id")
            ->join('categories','categories.categories_id','=','products.categories_id')
            ->select("status.status_name","products.*","categories.categories_name")
            ->orderBy('products.status_id','ASC')
            ->get();
            return view("admin.products", compact("product","status"));
        } else {
            return redirect("index")->with("alert","Bạn không có quyền truy cập trang này");
        }
    }

    public function getEditProduct(Request $req)
    {
        $categoriesAll = Categories::all();
        $categories = Categories::join('products','products.categories_id','=','categories.categories_id')
        ->where('products_id',$req->products_id)
        ->get();
        $product = Products::join('categories','categories.categories_id','=','products.categories_id')
        ->where('products_id',$req->products_id)->get();
        return view('admin.editProduct',compact('categories','product','categoriesAll'));
    }

    public function postEditProduct(Request $req,$products_id)
    {
        $product=Products::where('products_id',$products_id)->first();
        $this->validate($req,[
            "products_name" => "required",
            "products_price" => "required",
            "products_qty" => "required",
            "products_description" => "required",
            "products_img" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "categories_id" => "required",
            ],[
            "products_name.required"=>"Hãy điền tên sản phẩm",
            "products_price.required" => "Hãy điền giá sản phẩm",
            "products_qty.required" =>"Hãy điền số lượng tồn kho",
            "products_description.required" => "Hãy điền mô tả sản phẩm",
            "products_img.required" => "Hãy chọn hình ảnh",
            "products_img.image" => "File chọn phải là ảnh",
            "products_img.mimes" => "File ảnh phải thuộc dạng jpeg,png,jpg,gif,svg",
            "products_img.max"  => "File ảnh không được lớn hơn 2048 byte",
            "categories_id.required" => "Hãy chọn loại sản phẩm"
            ]);
        $current = Carbon::now();
        $product->products_name=$req->products_name;
        $product->products_price=$req->products_price;
        $product->products_qty=$req->products_qty;
        $product->products_description=$req->products_description;
        $product->expiry_day = $current->addDays(5);
        if($req->hasFile('products_img'))
        {
            $file = $req->file('products_img');
            $endwith = $file->getClientOriginalExtension();
            if($endwith != 'jpg' && $endwith != 'png' && $endwith != 'jpeg')
            {
                return redirect('editProduct/'.$products_id)->with('alert', 'Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $file->move(public_path('img/product'),$name);
            $product->products_img = $name;
        } else {
            $product->products_img = "";
        }

        $product->status_id = 1;
        $product->categories_id=$req->categories_id;
        $product->save();
        if(!$product->save()){
            return redirect()->back()->withInput()->with("alert","Có lỗi xảy ra");
        } else{
            return redirect("products")->with("message","Sửa thành công");
        }
    }

    public function postNewProduct(Request $req)
    {
        if($req->them){
            $this->validate($req,[
            "products_name" => "required",
            "products_price" => "required",
            "products_qty" => "required",
            "products_description" => "required",
            "products_img" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "categories_id" => "required",
            ],[
            "products_name.required"=>"Hãy điền tên sản phẩm",
            "products_price.required" => "Hãy điền giá sản phẩm",
            "products_qty.required" =>"Hãy điền số lượng tồn kho",
            "products_description.required" => "Hãy điền mô tả sản phẩm",
            "products_img.required" => "Hãy chọn hình ảnh",
            "products_img.image" => "File chọn phải là ảnh",
            "products_img.mimes" => "File ảnh phải thuộc dạng jpeg,png,jpg,gif,svg",
            "products_img.max"  => "File ảnh không được lớn hơn 2048 byte",
            "categories_id.required" => "Hãy chọn loại sản phẩm"
            ]);

        $product = new products;
        $current = Carbon::now();
        $product->products_name=$req->products_name;
        $product->products_price=$req->products_price;
        $product->products_qty=$req->products_qty;
        $product->products_description=$req->products_description;
        $product->expiry_day = $current->addDays(5);
        if($req->hasFile('products_img'))
        {
            $file = $req->file('products_img');
            $endwith = $file->getClientOriginalExtension();
            if($endwith != 'jpg' && $endwith != 'png' && $endwith != 'jpeg')
            {
                return redirect('products')->with('alert', 'Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
            }
            $name = $file->getClientOriginalName();
            $file->move(public_path('img/product'),$name);
            $product->products_img = $name;
        } else {
            $product->products_img = "";
        }

        $product->status_id = 1;
        $product->categories_id=$req->categories_id;
        $product->save();
        if(!$product->save()){
            return redirect()->back()->withInput()->with("alert","Có lỗi xảy ra");
        } else{
            return redirect("products")->with("message","Thêm thành công");
        }
        } else {
            $product = Products::where('products_id',$req->hiddenInput)
            ->update(['status_id' => $req->status_id]);
            return redirect("products")->with('message','Thay đổi tình trạng sản phẩm thành công');
        }
    }

    public function getDeleteProduct(Request $req)
    {
        $product= Products::where("products_id",$req->products_id);
        $product->delete();
        return redirect("products")->with("message","Xóa thành công");
    }
}
