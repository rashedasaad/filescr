<?php

namespace App\Http\Controllers;

use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Stripe;

class LoginController extends Controller
{

    public function login()
    {
        return Socialite::driver('discord')->redirect();
    }
    public function callback(Request $request)
    {
        $info = Socialite::driver('discord')->user();

        $stripe = new \Stripe\StripeClient(env('stripe_key'));
       

       

        $check_customer = User::where('user_id', $info->id)->get();

        if (sizeof($check_customer) == 0) {
            $cus_id = $stripe->customers->create([
                'email' =>$info->email,
                'name' => $info->name
              ]);
            $user = User::updateOrCreate(
                [
                    'user_id' => $info->id,

                ],
                [
                    'name' =>  $info->name,
                    'nickname' => $info->nickname,
                    'customer_id' => $cus_id["id"],
                    'email' =>  $info->email,
                    'avatar' => $info->avatar

                ]
            );
            $d = $request->session()->put("user_session", [
                'user_id' => $user->user_id,
                'name' =>  $user->name,
                'nickname' => $user->nickname,
                'email' =>  $user->email,
                'customer_id' => $cus_id["id"],
                'avatar' => $user->avatar,
                'is_ban' => 0,
                'is_admin' => 0
            ]);
            $request->session()->save();

            return redirect("/");
        }

        if ($check_customer[0]->is_ban == 1) {
            return redirect("/");
        }
       
        $sup = Sub::where('user_id', $info->id)->get();

        $user = User::updateOrCreate(
            [
                'user_id' => $check_customer[0]->user_id,

            ],
            [
                'name' =>  $info->name,
                'nickname' => $info->nickname,
                'customer_id' => $check_customer[0]->customer_id,
                'email' =>  $info->email,
                'avatar' => $info->avatar,
                'is_ban' => $check_customer[0]->is_ban,
                'is_admin' => $check_customer[0]->is_admin
            ]
        );
        if (sizeof($sup) == 0) {
            $sup_id = 0;
            $will_end = 0;

        }else
        {
            $sup_id = $sup[0]->sup_id;
            $will_end = $sup[0]->will_end;
        }
    
        $request->session()->put("user_session",[
            "id" => $user->id,
            'user_id' => $user->user_id,
            'name' =>  $user->name,
            'nickname' => $user->nickname,
            'email' =>  $user->email,
            'avatar' => $user->avatar,
            'is_ban' => $check_customer[0]->is_ban,
            'is_admin' => $check_customer[0]->is_admin,
            'customer_id' => $check_customer[0]->customer_id,
            'sup' =>   $sup_id,
            'will_end' =>   $will_end
        ]);
        $request->session()->save();

        return redirect("/account");
    
    }

    public function islogin(){
        return view("index");
    }

    public function account(){
        return view("login");
    }
}
