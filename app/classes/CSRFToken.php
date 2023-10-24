<?php

namespace App\Classes;

class CSRFToken
{
    public static function _token()
    {
        if (!Session::has("token")) {
            echo Session::add("token", base64_encode(openssl_random_pseudo_bytes(32)));
        }else{
            echo Session::get("token");
        }
    }
    public static function checkToken($token){
        return Session::get("token")===$token;
    
        }
    }

