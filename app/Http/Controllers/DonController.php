<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Donation;
use App\Notifications\Payment;

class DonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){

        return view('don.index');
    }

    public function prepaiement(Request $request){

        $request->validate([
            'amount' => 'required|numeric|max:200000|min:5',
        ]);

        $amount = $request->input('amount');
        session(['amount' => $amount]);
        return view('don.show', compact('amount'));     
        
    }

    public function paiement(Request $request)
    {
        if( $request->isMethod('post') ) 
           {
                $stripe_token = $request->get('stripeToken');
                $user = Auth::user();
                $donation = new Donation;
                $donation->user_id = $user->id;
                $donation->stripe_token = $stripe_token;                
                $donation->amount = session('amount');
                $donation->save();                

                \Stripe\Charge::create(array(
                        "currency" => "eur",
                        "source" => $stripe_token,
                        "amount"   => session('amount')*100,
                        "description" => "Playlist donation by user_id ". $user->id                                              
                ));                   
           }  
           $user->notify(new Payment('donation'));

        return back()->with('message', __('Merci pour votre don'));
    }

    public function historyDonation(){
        $donations = Auth::user()->donations->all(); //return array
        // dd(var_dump($donations)); 
        return view('don/donations', compact('donations'));
    }

}
