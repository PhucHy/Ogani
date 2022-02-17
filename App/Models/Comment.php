<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Cart;
use App\Models\Products;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comment";
    protected $primaryKey = "comment_id";
    public static function displayComment()
    {
        $sql = DB::table("comment")
        ->join('users','users.id','=','comment.id')
        ->join('products','products.products_id','=','comment.products_id')
        ->join('status','status.status_id','=','comment.status_id')
        ->select('users.name','comment.*','products.products_name','status.status_name')
        ->get();
        return $sql;
    }


}
