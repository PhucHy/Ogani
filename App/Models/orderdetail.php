<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Pagination\Paginator;
class orderdetail extends Model
{
    use HasFactory;
    protected $table = "orderdetail";

    public static function displayOrderdetail(Request $req)
    {
        $sql = DB::table("orderdetail")
        ->join("products","products.products_id","=","orderdetail.products_id")
        ->join("order","order.order_id","=","orderdetail.order_id")
        ->where('order.order_id', $req->order_id)
        ->select("order.*","products.*","orderdetail.*")
        ->paginate(10);
        return $sql;
    }
}
