<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function index(){
        Stripe::setApiKey(env("STRIPE_SECRET"));
        $users = \Stripe\Customer::all();
        // $users = json_decode(\Stripe\Customer::all());

        return view('stripe.index', compact('users'));
        // return view('stripe.index', with('users', json_decode($users, true)));

        // $stripe_customers = \Stripe\Customer::all(['limit' => 3]);     
        // return view('stripe.index', with('stripe_customers', json_decode($stripe_customers, true)));
    }

    public function subscriptionList(){
        Stripe::setApiKey(env("STRIPE_SECRET"));
        $subscriptions = \Stripe\Subscription::all();

        return view('stripe.subscr', compact('subscriptions'));

    }
}
