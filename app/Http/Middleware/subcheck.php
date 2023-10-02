<?php

namespace App\Http\Middleware;

use App\Models\Free;
use App\Models\Sub;
use Closure;
use Illuminate\Http\Request;

class subcheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user_info = $request->session()->get("user_session");
        $Sub = Sub::where('user_id', $user_info["user_id"])->get();
        $Free = Free::where('user_id', $user_info["user_id"])->get();
        $boolsub = true;
        $boolfree = true;



        if (sizeof($Sub) == 0) {
            $boolsub = false;
        }
        if (sizeof($Free) == 0) {
            $boolfree = false;
        }
        if ($boolsub == true) {

            if ($Sub[0]->will_end > date("Y-m-d\TH:i:s")) {
                return $next($request);
            } elseif ($boolfree == true) {
                return $next($request);
            } else {
                return redirect("/product")->with("status", "you do not have a subscption");
            }
        } elseif ($boolfree == true) {
            if ($Free[0]->is_free == 1) {
                return $next($request);
            } else {
                return redirect("/product")->with("status", "you do not have a subscption");
            }
        } else {
            return redirect("/product")->with("status", "you do not have a subscption");
        }
    }
}
