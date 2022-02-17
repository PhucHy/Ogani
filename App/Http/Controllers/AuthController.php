<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Users;
use Hash;

class AuthController extends Controller
{
    public function getRegister()
    {
        return view("pages.signup");
    }

    public function postRegister(Request $request)
    {
        if($request->home){
            return redirect("/");
        }
        $this->validate($request,
            [
                "email"     => "required|email:rfc,dns|unique:users,email|ends_with:gmail.com,hotmail.com,yahoo.com",
                "password"  => "required|min:5|max:18",
                "name"      => "required|regex:/[a-zA-Z\- ]+/i",
                "address"   => "required",
                "phone"     => "required|numeric"
            ],[
                "email.email"       =>  "Email không đúng định dạng",
                "email.required"    =>  "Bạn chưa nhập email",
                "password.required" =>  "Bạn chưa nhập mật khẩu",
                "name.required"     =>  "Bạn chưa nhập tên người dùng",
                "phone.required"    =>  "Bạn chưa nhập SĐT",
                "address.required"  =>  "Bạn chưa nhập địa chỉ",
                "email.unique"      =>  "Email đã tồn tại",
                "password.min"      =>  "Mật khẩu không được ít hơn 5 ký tự",
                "password.max"      =>  "Mật khẩu không được nhiều hơn 18 ký tự",
                "name.max"          =>  "Tên người dùng không được quá 30 ký tự",
                "email.ends_with"   =>  "Email phải là gmail hoặc hotmail",
                "phone.numeric"     =>  "SĐT phải là số",
                "phone.max"         =>  "SĐT không được nhiều hơn 12 số",
                "name.regex"        =>  "Tên người dùng chỉ được chứa ký tự"
            ]);
                $user = new user;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->pass = hash::make($request->password);
                $user->address = $request->address;
                
                $user->save();
                if(!$user->save()){
                    return redirect()->back()->withInput()->with("success","Đăng ký thàng công");
                } else{
                    return redirect("login")->with("success","Đăng ký thàng công");
                }
    }

    public function getLogin()
    {
        return view("pages.login");
    }

    public function postLogin(Request $request)
    {
        if($request->home){
            return redirect('/');
        }
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
            $username=$user->name;
            $id = $user->id;
            $role = $user->roles_id;
            $email = $user->email;
            if(Hash::check($request->password,$user->pass))
            {
                if($user->roles_id == 1)
                {
                    session(["adid"=>$id]);
                    session(["ademail"=>$email]);
                    session(["adroles_id"=>$role]);
                    session(['adname'=>$username]);
                    return redirect("/")->with("message","Đăng nhập thành công");
                } elseif($user->roles_id == 2){
                    session(["id"=>$id]);
                    session(["email"=>$email]);
                    session(["name"=>$username]);
                    return redirect("/")->with("message","Đăng nhập thành công");    
                }
            } else
                return redirect("login")->back()->withInput()->with("wrongpass","Mật khẩu không đúng");
        }
        else
            return redirect("login")->back()->withInput()->with("nouser","Tài khoản chưa đăng ký");
    }

    public function Logout(Request $request)
    {
        if(session('email')){
            $request->session()->forget("name");
            $request->session()->forget("id");
            $request->session()->forget("email");
            return redirect("/")->with("message","Đăng xuất thành công");
        } elseif(session('ademail')){
            $request->session()->forget("adid");
            $request->session()->forget("adroles_id");
            $request->session()->forget("ademail");
            return redirect("/")->with("message","Đăng xuất thành công");
        }
        
    }

    public function getEdit($id)
    {
        $user = user::find($id);
        return view('pages.edit-account')->with('user',$user);
    }

    public function postEdit(Request $req,$id)
    {
        if($req->home){
            return redirect('/');
        }
        $this->validate($req,
            [
                "password"  => "required|min:5|max:18",
                "name"      => "required|regex:/[a-zA-Z\- ]+/i",
                "address"   => "required",
                "phone"     => "required|numeric"
            ],[
                "password.required" =>  "Bạn chưa nhập mật khẩu",
                "name.required"     =>  "Bạn chưa nhập tên người dùng",
                "phone.required"    =>  "Bạn chưa nhập SĐT",
                "address.required"  =>  "Bạn chưa nhập địa chỉ",
                "password.min"      =>  "Mật khẩu không được ít hơn 5 ký tự",
                "password.max"      =>  "Mật khẩu không được nhiều hơn 18 ký tự",
                "name.max"          =>  "Tên người dùng không được quá 30 ký tự",
                "phone.numeric"     =>  "SĐT phải là số",
                "phone.max"         =>  "SĐT không được nhiều hơn 12 số",
                "name.regex"        =>  "Tên người dùng chỉ được chứa ký tự"
            ]);

        $user =user::find($id);
        $user->name = $req->name;
        $user->address = $req->address;
        $user->phone = $req->phone;
        $user->pass = hash::make($req->password);
        $user->save();
        return redirect('/')->with('message','Sửa thành công');
    }
}
