<?php

namespace App\Http\Controllers;

use App\Models\Sub;
use Exception;
use Illuminate\Http\Request;
use Stripe;

class Subscontroller extends Controller
{
  public function index()
  {

    $stripe = new \Stripe\StripeClient(
      env("stripe_key"),
    );
    $productss = $stripe->products->all();
    $plans = $stripe->plans->all();
    $prods = [];

    for ($i = 0; $i < count($productss->data); $i++) {
      for ($x = 0; $x < count($plans->data); $x++) {
        if ($productss->data[$i]->id == $plans->data[$x]->product) {

          array_push($prods, [
            "product_name" => $productss->data[$i]->name,
            "intervalue"  => $plans->data[$x]->interval,
            "product_id"  => $productss->data[$i]->id,
            "plan_id" => $plans->data[$x]->id,
            "price" => $plans->data[$x]->amount / 100

          ]);
        }
      }
    }
    return view("subs", compact("prods"));
  }

  public function token_payment(Request $request, $product_id, $plan_id)
  {
    return view("card", compact("product_id", "plan_id"));
  }

  public function create_sub(Request $request)
  {
    $request->validate([
      "product_name" => "required",
      "plan_id" => "required"
    ]);

    $product_name =  $request->input("product_name");
    $plan_id =  $request->input("plan_id");
    $token =  $request->input("stripeToken");
    $product_name = FuncsController::xssfilter($product_name);
    $plan_id = FuncsController::xssfilter($plan_id);

    $user = $request->session()->get("user_session");

    $stripe = new \Stripe\StripeClient(env('stripe_key'));

    try {
      $status = $stripe->subscriptions->create([

        'customer' =>  $user["customer_id"],

        'items' => [
          ['price' => $plan_id],
        ],
      ]);

      if ($status) {

        Sub::create([
          "user_id" => $user["user_id"],
          "sup_id" => $status["id"],
          "product_id" => $status["plan"]["product"],
          "first_invoices_id" => $status["latest_invoice"],
          "first_payment_intent_id" => 0,
          "will_end" => gmdate("Y-m-d\TH:i:s", $status["current_period_end"]),
        ]);
        return redirect("/scripts");
      }
    } catch (Exception $e) {
      return redirect("/product")->with("statusbad",$e->getMessage());
    }
  }
}
