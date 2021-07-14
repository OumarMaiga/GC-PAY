<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Session;
use Stripe;

class StripeController extends Controller
{
    //
        function formulaire() {
            return view ('paiements.credit_card');
        }
        

      function process(Request $request) { 
         Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            Stripe\Charge::create ([
                    "amount" => 100 * 100,
                    "currency" => "eur",
                    "source" => $request->stripeToken,
                    "description" => "Paiement reçu de GC-PAY"
            ]);
       
            Session::flash('success', 'Payment successful!');
               
            return back();
        
    }

    function paiementOk() {
        dd("Paiement OK");
      }
}
