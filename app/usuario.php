<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class usuario extends Model
{
    public static function login($email,$password) {
        $user = DB::table('usuarios')->select('nombre')->where('email',$email)->where('password',$password)->count();
        return $user;
    }
}
