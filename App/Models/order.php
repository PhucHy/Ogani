<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class order extends Model
{
    use HasFactory;
    protected $table = "order";

    public static function displayOrder()
    {
        $sql = DB::table("order")
        ->join("users","order.email","=","users.email")
        ->join("status","status.status_id","=","order.status_id")
        ->select("order.*","users.email","status.status_name")
        ->orderBy("order.order_id","ASC")->paginate(10);
        return $sql;
    }

}
