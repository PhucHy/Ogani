<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Models\Products;
use DB;
use Session;

class CartController extends Controller
{


    public function addtoCart(Request $req)
    {
        if(session('email') || session('ademail'))
        {
            $products=$req->products_id;
            $qty=$req->qty;
    
            $products_info=Products::where('products_id',$products)->get();
    
            $data['id']=$products_info[0]->products_id;
            $data['qty']=$qty;
            $data['name']=$products_info[0]->products_name;
            $data['price']=$products_info[0]->products_price;
            $data['weight']=$products_info[0]->products_qty;
            $data['options']['image']=$products_info[0]->products_img;
    
            \Cart::add($data);
            return redirect("cart");
        }
        else
        {
            return redirect('login')->with('non-user','Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
        }
    }

    public function showCart()
    {
        return view("pages.cart");
    }

    public function deleteCart($rowId){
        \Cart::update($rowId,0);
        return redirect("cart");
    }

    public function updateCart(Request $req){
        $rowId=$req->rowId_cart;
        $qty=$req->cart_qty;
        \Cart::update($rowId,$qty);
        return redirect("cart");
    }

    public function getCheckout()
    {
        return view("pages.checkout");
    }

    public function checkOut(Request $req)
    {
        $content=\Cart::content();
        if($content->count() != 0)
        {
            $this->validate($req,
                [
                    "receiver"=>"required|regex:/[a-zA-Z\- ]+/i",
                    "receiver_phone"=>"required|numeric",
                    "buyer"=>"required|regex:/[a-zA-Z\- ]+/i",
                    "buyer_phone"=>"required|numeric",
                    "receiver_address"=>"required",
                ],
                [
                    "receiver.required"=>"Hãy điền họ tên người nhận",
                    "receiver_phone.required"=>"Hãy điền số điện thoại người nhận",
                    "receiver_phone.numeric"=>"Số điện thoại phải là số",
                    "buyer.required"=>"Hãy điền họ tên người mua",
                    "buyer_phone.required"=>"Hãy điền số điện thoại người mua",
                    "buyer_phone.numeric"=>"Số điện thoại phải là số",
                    "receiver_address.required"=>"Hãy điền địa chỉ người nhận",
                    "receiver.regex" => "Tên người dùng chỉ được chứa ký tự",
                    "buyer.regex" => "Tên người dùng chỉ được chứa ký tự"
                ]);
            $data= array();
            $data["email"]= $req->email;
            $data["receiver"]=$req->receiver;
            $data["receiver_phone"]=$req->receiver_phone;
            $data["buyer"]=$req->buyer;
            $data["buyer_phone"]=$req->buyer_phone;
            $data["receiver_address"]=$req->receiver_address;
            $data["payment_methods"]= "COD";
            $data["sum"]=\Cart::pricetotal();
            $data["status_id"]=4;

            $order_id= DB::table("order")->insertGetId($data);
            Session::put("order_id",$order_id);
        
            foreach($content as $product)
            {
                $orderdetail["order_id"]=$order_id;
                $orderdetail["products_id"]=$product->id;
                $orderdetail["product_price"]=$product->price;
                $orderdetail["product_qty"]=$product->qty;
                $orderdetail["products_name"]=$product->name;
                DB::table("orderdetail")->insert($orderdetail);
            }

            foreach($content as $products)
            { 
                $products_id=$products->id;
                $product=Products::where("products_id",$products_id)->first();
                $product->products_qty=$product->products_qty-$products->qty;
                $product->save();
            }

            if($data["status_id"]!=null)
            {
                \Cart::destroy();
                return redirect()->back()->withInput()->with("success","Thanh toán thành công");
            } 
            else 
            {
                return redirect()->back()->withInput()->with("fail","Thành toán thật bại");
            }
            
        }
        else
        {
            return redirect('checkout')->with("non-item","Giỏ hàng trống không thể thanh toán");
        }
    }
}
