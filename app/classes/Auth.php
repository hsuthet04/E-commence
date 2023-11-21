<?php

namespace App\Classes;
use App\Models\User;

class Auth{
    public static function check(){
        return Session::has("user_id");
    }
    public static function user(){
        if(self::check()){
            $user=User::where("id",Session::get("user_id"))->first();
            return $user;
        }
    }
}