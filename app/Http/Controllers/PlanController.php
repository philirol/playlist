<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\{Plan,User};
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;
use App\Traits\SubscriptionControlTrait;
// use Symfony\Component\Debug\Exception\FatalThrowableError;

class PlanController extends Controller
{
    use SubscriptionControlTrait;

    public function __construct(){
        
        $this->middleware('auth');
        $this->middleware('admin')->only('createProduct','createPlan');
    }
    
    public function index(){
        // $array_id_users_band = User::where('band_id', Auth::user()->band->id)->get()->modelKeys();
        // if (!empty($subscr_id = DB::table('subscriptions')->whereDate('updated_at','>', Carbon::now()->subYear())->whereIn('user_id',$array_id_users_band)->get())){
        if($this->BandHasValidSubscription()->isNotEmpty()){ 
            $subscr = $this->BandHasValidSubscription()->first();
            //pour retourner l'utilisateur du groupe qui s'est abonné
            $banduserSubscr = User::find($subscr->user_id); //return Eloquent object
            $plan = DB::table('plans')->where('stripe_plan', $subscr->stripe_plan)->first(); //return stdclass object
            $band = Auth::user()->band;
            return view('plans.show', compact('plan', 'banduserSubscr','band'));            
        }

        $plans = Plan::where('slug','<>','free')->get();
        return view('plans.show', compact('plans'));
    }

    public function show(Plan $plan, Request $request){ 
        // try {
        $paymentMethods = $request->user()->paymentMethods();
        $intent = $request->user()->createSetupIntent();
        // } catch (FatalThrowableError $e) {
        //     return back()->with('messageDanger', __('Il y a eu un problème technique. Signaler votre problème dans Contact'));
        // }
        return view('plans.process', compact('plan', 'intent'));
    }

    public function createProduct(Request $request){
        // dd($request->product);
        Stripe::setApiKey(env("STRIPE_SECRET"));
        $product = \Stripe\Product::create([
            'name' => $request->product,
            'type' => 'service',
        ]);
        return back()->with('message', 'Le produit a bien été créé');
    }

    public function createPlan(Request $request){
        // dd($request->plan);
        Stripe::setApiKey(env("STRIPE_SECRET"));

       $plan = \Stripe\Plan::create([
            'currency' => 'eur',
            'interval' => 'year',
            'product' => $request->id_product,
            'id' => $request->plan,
            'nickname' => $request->nickname,
            'amount' => $request->amount,
        ]);
        return back()->with('message', 'Le plan a bien été créé');
    }
}
