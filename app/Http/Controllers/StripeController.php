<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Session;
use Stripe;
use App\Models\Service;

class StripeController extends Controller
{
    //
        function formulaire() {
            $data = session()->get("data");
            return view ('paiements.credit_card', compact('data'));
        }
        

      function process(Request $request) { 
        $data = session()->get("data");
        if (array_key_exists('montant_payer', $data)){
            $montant = $data['montant_payer'];
        }elseif (array_key_exists('montant', $data)){
            $montant = $data['montant'] ;
        }else{
            $montant = Service::findOrFail($data['service_id'])->prix;
        }
         Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            Stripe\Charge::create ([
                    "amount" => $montant,
                    "currency" => "xof",
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
