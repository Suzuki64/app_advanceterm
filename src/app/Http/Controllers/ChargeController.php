<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;


class ChargeController extends Controller
{
   public function charge(Request $request)
    {
        try
        {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = Charge::create(array(
                'amount' => 1000,
                'currency' => 'jpy',
                'source'=> request()->stripeToken,
            ));

            return back();
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
}
