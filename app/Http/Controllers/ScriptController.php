<?php

namespace App\Http\Controllers;

use App\Models\active;
use App\Models\script_name;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function script(Request $request)
    {

        $user_info = $request->session()->get("user_session");
        $actives = active::where('user_id', $user_info["user_id"])->get();
        $scripts = script_name::where('user_id', $user_info["user_id"])->get();



        return view("script", compact('scripts', "actives"));
    }
    public function actievs(Request $request)
    {
        $user_info = $request->session()->get("user_session");
        $actives = active::where('user_id', $user_info["user_id"])->get();
        $scripts = script_name::where('user_id', $user_info["user_id"])->get();
        return view("active", compact('actives', "scripts"));
    }

    public function store_script(Request $request)
    {

        $request->validate([
            "script" => "required",
        ]);

        $script_store =  $request->input("script");
        $script_store =  FuncsController::xssfilter($script_store);

        $user_info = $request->session()->get("user_session");

        script_name::create([
            "user_id" => $user_info["user_id"],
            "script_id" =>   FuncsController::generatenumber(20),
            "script_name" =>  $script_store,
            "script_token" =>  FuncsController::generateToken(20),
        ]);



        return redirect('/scripts');
    }

    public function store_active(Request $request)
    {

        $user_info = $request->session()->get("user_session");
        $request->validate([
            "server_name" => "required",
            "script_id" => "required",
            "ip_server" => "required",
            "discord_id" => "required",
        ]);

        $server_name =  $request->input("server_name");
        $script_id =  $request->input("script_id");
        $ip_server =  $request->input("ip_server");
        $discord_id =  $request->input("discord_id");

        $server_name = FuncsController::xssfilter($server_name);
        $discord_id =  FuncsController::xssfilter($discord_id);
        $script_id = FuncsController::xssfilter($script_id);
        if (!filter_var($ip_server, FILTER_VALIDATE_IP)) {
            return redirect("/actievs")->with('statusbad', "The ip is not correct");
        }
        if ($discord_id < 20) {
            return redirect("/actievs")->with('statusbad', "Please check the discord id");
        }


        $check_customer = script_name::where('user_id', $user_info["user_id"])->get();



        for ($i = 0; $i < count($check_customer); $i++) {
            if ($check_customer[$i]->script_id ==  $script_id) {

                active::create([
                    "user_id" => $user_info["user_id"],
                    "script_id" =>    $check_customer[$i]->script_id,
                    "script_name" =>    $check_customer[$i]->script_name,
                    "server_name" =>  $server_name,
                    "discord_id" =>  $discord_id,
                    "ip_server" =>   $ip_server,
                    "script_licens" =>   FuncsController::generateToken(15),
                    "script_token" =>  $check_customer[0]->script_token,
                    "script_status" =>   true,
                ]);
                return redirect("/actievs");
            }
        }


        return redirect('/actievs');
    }

    public function delete(Request $request)
    {
        $request->validate([
            "delete_id" => "required",
        ]);
        $delete_id = $request->input("delete_id");
        $user_info = $request->session()->get("user_session");
        $check_customer = active::where('user_id', $user_info["user_id"])->get();

        for ($i = 0; $i < count($check_customer); $i++) {
            if ($check_customer[$i]->id == $delete_id) {

                $script = active::find($check_customer[$i]->id);
                $script->delete();
                return redirect("/actievs");
            }
        }
        return redirect("/actievs");
    }
    public function delete_scripts(Request $request)
    {
        $request->validate([
            "delete_id" => "required",
        ]);

        $delete_id = $request->input("delete_id");
        $user_info = $request->session()->get("user_session");
        $check_customer = script_name::where('user_id', $user_info["user_id"])->get();

        for ($i = 0; $i < count($check_customer); $i++) {
            if ($check_customer[$i]->id == $delete_id) {

                $script = script_name::find($check_customer[$i]->id);
                $script->delete();
                return redirect("/scripts");
            }
        }


        return redirect("/scripts");
    }

    public function update_active(Request $request)
    {

        $request->validate([
            "active_id" => "required"
        ]);

        $active_id =  $request->input("active_id");
        $active_id = FuncsController::xssfilter($active_id);

        $user_info = $request->session()->get("user_session");
        $check_customer = active::where('user_id', $user_info["user_id"])->get();

        for ($i = 0; $i < count($check_customer); $i++) {
            if ($check_customer[$i]->id == $active_id) {

                if ($check_customer[$i]->script_status == true) {
                    active::find($check_customer[$i]->id)->update(["script_status" => 0]);
                    break;
                } else {
                    active::find($check_customer[$i]->id)->update(["script_status" => 1]);
                    break;
                }
            }
        }
        return redirect("/actievs");
    }


    public function update_form_actievs(Request $request)
    {
        $request->validate([
            "id" => "required"
        ]);

        $server_name =  $request->input("server_name");
        $ip =  $request->input("ip_server");
        $discord_id =  $request->input("discord_id");
        $id =  $request->input("id");
        $server_name = FuncsController::xssfilter($server_name);
        $ip = FuncsController::xssfilter($ip);
        $discord_id = FuncsController::xssfilter($discord_id);
        $id = FuncsController::xssfilter($id);


        if (!is_numeric($id) || !is_numeric($discord_id)) {
            return redirect("/actievs");
        }
        if (!is_string($server_name)) {
            return redirect("/actievs");
        }

        $user_info = $request->session()->get("user_session");
        $check_customer = active::where('user_id', $user_info["user_id"])->get();

        for ($i = 0; $i < count($check_customer); $i++) {
            if ($check_customer[$i]->id == $id) {
                active::find($check_customer[$i]->id)->update(["server_name" => $server_name, "ip_server" => $ip, "discord_id" => $discord_id]);
                break;
            }
        }
        return redirect("/actievs");
    }
    public function update_form_scripts(Request $request)
    {
        $request->validate([
            "script_name" => "required",
            "id_script" => "required"
        ]);

        $scriptname =  $request->input("script_name");
        $id =  $request->input("id_script");
        $scriptname = FuncsController::xssfilter($scriptname);
        $id = FuncsController::xssfilter($id);

        if (!is_numeric($id)) {
            return redirect("/scripts");
        }
        if (!is_string($scriptname)) {
            return redirect("/scripts");
        }

        $user_info = $request->session()->get("user_session");
        $check_customer = script_name::where('user_id', $user_info["user_id"])->get();

        for ($i = 0; $i < count($check_customer); $i++) {
            if ($check_customer[$i]->id == $id) {

                script_name::find($check_customer[$i]->id)->update(["script_name" => $scriptname]);;
                break;
            }
        }
        return redirect("/scripts");
    }
}
