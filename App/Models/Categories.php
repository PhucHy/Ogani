<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Categories extends Model
{
    protected $table = "categories";
    protected $primaryKey = "categories_id";
    protected $keyType = 'string';
    public $incrementing = false;

    public static function displayCategories()
    {
        $sql = DB::table("categories")->get();
        return $sql;
    }
}
