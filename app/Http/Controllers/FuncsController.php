<?php

namespace App\Http\Controllers;

use App\Models\Free;
use App\Models\Sub;
use Illuminate\Http\Request;

class FuncsController extends Controller
{
    public static function getUserIpAddr()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }

        // Sometimes the `HTTP_CLIENT_IP` can be used by proxy servers
        $ip = @$_SERVER['HTTP_CLIENT_IP'];
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
           return $ip;
        }

        // Sometimes the `HTTP_X_FORWARDED_FOR` can contain more than IPs 
        $forward_ips = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        if ($forward_ips) {
            $all_ips = explode(',', $forward_ips);

            foreach ($all_ips as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)){
                    return $ip;
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'];
    
    }

    public static function generateToken($length)
    {
        $allowedCharacters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        $allowedCharactersLength = mb_strlen($allowedCharacters, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $token .= $allowedCharacters[random_int(0, $allowedCharactersLength)];
        }
        return $token;
    }
    public static function generatenumber($length)
    {
        $allowedCharacters = '0123456789';
        $token = '';
        $allowedCharactersLength = mb_strlen($allowedCharacters, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $token .= $allowedCharacters[random_int(0, $allowedCharactersLength)];
        }
        return $token;
    }
    public static  function test($str)
    {
        $re = '/^(?=[a-zA-Z0-9_]{4,30}$)(?!.*[_]{2})[^_].*[^_]$/';

        if (preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0) == true) {
            return "good";
        } else {
            return "fail";
        }
    }
    public static  function emailfilter($str)
    {
        $re = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

        if (preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0) == true) {
            return "good";
        } else {
            return "fail";
        }
    }
 
    public static  function xssfilter($str)
    {
        $danger = array("<", ">", "/", "src", "select", "*", "<script>", "%", "&");
        $xss_filter = str_replace($danger, "", $str);

        return  $xss_filter;
    }
    public static  function is_sub($request)
    {
        $user_info = $request->session()->get("user_session");
        $Sub = Sub::where('user_id', $user_info["user_id"])->get();
        $free = Free::where('user_id', $user_info["user_id"])->get();

        
       if($free[0]->is_free = 1){
        return true;
       }
       return false;
    }
}
