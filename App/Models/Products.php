<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Cart;
use App\Models\Comment;
class Products extends Model
{
    protected $table = "products";
    protected $primaryKey = "products_id";

    public static function displayProducts($products_id)
    {
        $sql = DB::table("products")
        ->join("comment","products.products_id","=","comment.products_id")
        ->join("status","status.status_id","=","products.status_id")
        ->select("comment.*","status.*","products.*")
        ->where("products_id",$products_id)->get();
        return $sql;
    }
}
