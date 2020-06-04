<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Plan;
use Stripe\Stripe;
use App\Traits\SubscriptionControlTrait;
use Illuminate\Support\Facades\DB;
use App\Notifications\Payment;

class SubscriptionController extends Controller
{
    use SubscriptionControlTrait;

    public function __construct()
    {
        $this->middleware('admin')->only('index','subscriptionList');
        $this->middleware('auth')->only('create','show','delete');
    }
    
    public function index(){
        Stripe::setApiKey(env("STRIPE_SECRET"));
        $users = \Stripe\Customer::all();
        // $users = json_decode(\Stripe\Customer::all());

        return view('subscr.index', compact('users'));
        // return view('stripe.index', with('users', json_decode($users, true)));
        // $stripe_customers = \Stripe\Customer::all(['limit' => 3]);     
        // return view('stripe.index', with('stripe_customers', json_decode($stripe_customers, true)));
    }

    public function subscriptionList(){
        Stripe::setApiKey(env("STRIPE_SECRET"));
        $subscriptions = \Stripe\Subscription::all();

        return view('subscr.subscrList', compact('subscriptions'));

    }
    
    public function create(Request $request, Plan $plan)
    {
        $plan = Plan::findOrFail($request->get('plan'));
        $user = $request->user();
        $paymentMethod = $request->paymentMethod;

        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $user
            ->newSubscription('main', $plan->stripe_plan)
            ->create($paymentMethod, [
                'email' => $user->email,
        ]);

        $band = $user->band;
        $band->id_plan = $plan->id;
        $band->save();
        $user->notify(new Payment('subscription'));
            
        return redirect('songs')->with('message', __('Merci pour votre abonnement'));
        // return back()->with('message', __('Votre abonnement a bien été pris en compte'));
    }

    public function show(){
        $userCustomer = $this->userCustomer(Auth::user());
        return view('subscr.manage', compact('userCustomer'));
    }

    public function delete(){
        $subscription_id = $this->getUserSubscrId(Auth::user());
        $subscription = \Stripe\Subscription::retrieve($subscription_id);
        $subscription->delete();
        DB::table('subscriptions')->where('user_id', Auth::user()->id)->update(['stripe_status' => 'subscr_deleted']);
        return view('subscr.confirmdeleted');
    }
}