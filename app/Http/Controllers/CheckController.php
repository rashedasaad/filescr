<?php

namespace App\Http\Controllers;

use App\Models\active;
use App\Models\file_licens_error;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function index(Request $request, $lic, $name, $token)
    {


        $ip = FuncsController::getUserIpAddr();
        $active = active::where("script_licens", "=", $lic, "AND")->where("server_name", "=", $name, "AND")->where("script_token", "=", $token)->where("ip_server", "=", $ip)->first();
        $files_error = file_licens_error::where("script_licens", "=", $lic)->first();


        if (!empty($active)) {
            if (!empty($files_error)) {
                if ($files_error[0]->number_error > 5) {
                    echo "d";
                }
            }
       
            if ($active[0]->script_status == 1) {
                echo "good";
            } else {
                echo "offline";
            }
        } else {
            echo "bad";
        }
    }
}
