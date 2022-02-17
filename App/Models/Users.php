<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;

class Users extends Model
{
    // use HasFactory;
    protected $table = "users";
    public static function displayUsersdata()
    {
    	$sql = DB::table("users");
    	return $sql;
    }
}
