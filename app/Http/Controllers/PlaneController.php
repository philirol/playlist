<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Stripe;
use Billable;

class PlanEController extends Controller
{
    public function index(){
        return view('plane.index');
    }

    public function prepaiement(Request $request){
        $prix = $request->input('prix');
        session(['prix' => $prix]);
        return view('plane.paiement', compact('prix'));     
        
    }

    public function paiement(Request $request)
    {
        // dd($request);        
        $user = Auth::user();

        if( $request->isMethod('post') ) 
           {
                $stripe_token = $request->get('stripeToken');
                // dd($user);
                
                $user->stripe_id = $stripe_token;
                $user->card_brand = session('prix');
                $user->save();                

                \Stripe\Charge::create(array(
                        "currency" => "eur",
                        "customer" => $stripe_token,
                        "amount"   => session('prix')                                                
                ));
                           
           }
  
        return redirect('songs')->with('message', __('Votre paiement a bien été effectué'));
    }

}
