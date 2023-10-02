<?php

namespace App\Http\Controllers;

use App\Models\Free;
use App\Models\script_name;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Request;

class CpanelController extends Controller
{

    public function __construct()
    {
        $this->middleware('is_admin');
    }
    public function index()
    {
        $buyers = Sub::count();
        $users = User::paginate(1);
        $usernum = User::count();
        $scripts = script_name::count();

        return view("Dashboard", compact("buyers", "users", "usernum", "scripts",));
    }


    public function givefree(Request $request)
    {
        
        $request->validate([
            "free" => "required"
        ]);

        $free = $request->input("free");

        $freedb = Free::where("user_id", $free)->first();
      
        if (sizeof($freedb) == 0) {
        
            Free::create(["user_id" => $free, "is_free" => 1]);
            return redirect("admin/cpanel");
        } elseif($freedb[0]->is_free == 1){
            Free::where("user_id",$freedb[0]->user_id)->update(["is_free" => 0]);
            return redirect("admin/cpanel");
        }elseif($freedb[0]->is_free == 0){
            Free::where("user_id",$freedb[0]->user_id)->update(["is_free" => 1]);
            return redirect("admin/cpanel");
        }
     
        return redirect("admin/cpanel");
    }


    public function ban(Request $request){

        $request->validate([
            "ban" => "required"
        ]);

        $ban = $request->input("ban");

        $bandb = User::where("user_id", $ban)->first();
        
        if($bandb->is_ban == 1){
            User::where("user_id",$ban)->update(["is_ban" => 0]);
            return redirect("admin/cpanel");
        }elseif($bandb->is_ban == 0){
            User::where("user_id",$ban)->update(["is_ban" => 1]);
            return redirect("admin/cpanel");
        }
    }

    public function delete(Request $request){
        $request->validate([
            "delete_id" => "required"
        ]);

        return dd($request);
        $delete = $request->input("delete_id");
        $delete = User::find($delete)->delete();




        
    }
}
