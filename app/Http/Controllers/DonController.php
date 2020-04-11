<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonController extends Controller
{
    public function index(){

        return view('don.index');
    }

    public function prepaiement(Request $request){
        $prix = $request->input('prix');
        session(['prix' => $prix]);
        return view('don.show', compact('prix'));     
        
    }

    public function paiement(Request $request)
    {
        // dd($request->get('stripeToken'));        
        $user = Auth::user();

        if( $request->isMethod('post') ) 
           {
                $stripe_token = $request->get('stripeToken');
                
                $user->stripe_id = $stripe_token;
                $user->card_brand = session('prix');
                $user->save();                

                \Stripe\Charge::create(array(
                        "currency" => "eur",
                        "source" => $stripe_token,
                        "amount"   => session('prix')*100,
                        "description" => "Payment from Playlist. User_id : ". $user->id                                              
                ));
                           
           }
  
        return redirect('songs')->with('message', __('Votre paiement a bien été effectué'));
    }

}
