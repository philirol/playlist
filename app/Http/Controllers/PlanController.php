<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\{Plan,User};
use Carbon\Carbon;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function __construct(){
        
        $this->middleware('auth');
        $this->middleware('admin')->only('createProduct','createPlan');
    }
    
    public function index(){

        if(Auth::check()){
        // On veut savoir s'il y a des membres du groupe de l'user qui ont pris un abonnement:      
        //Pour cela on prend déjà tous les id des users qui appartiennent au groupe, modelKeys en fait un array
        $array_id_users_band = User::where('band_id', Auth::user()->band->id)->get()->modelKeys();

        //puis on vérifie si la colonne user_id de la table subscriptions contient des éléments de cet array avec la méthode whereIn
        //ca nous retourne l'abonnement pris par un des membres du groupe, sous forme d'instance de la classe collection par la méthode get
        //pour la date il faut qu'elle soit supérieure à la date d'aujourd'hui moins un an (abonnement valide)
        // $today_less_one_year = Carbon::now()->subYear();
            if (!empty($subscr_id = DB::table('subscriptions')->whereDate('updated_at','>', Carbon::now()->subYear())->whereIn('user_id',$array_id_users_band)->get())){

            //on peut utiliser first car il n'y a qu'un abonnement valide par groupe
            //$band_subscr = $subscr_id->isNotEmpty(); // retourne true ou false (au cas où, ca peut servir)
            $subscr = $subscr_id->first(); //return stdclass object
            // dd(Plan::where('stripe_plan', $subscr->stripe_plan)->first());
                if ($subscr !== null){
                    // dd($subscr);
                //pour retourner l'utilisateur du groupe qui s'est abonné
                $banduserSubscr = User::find($subscr->user_id); //return Eloquent object
                $plan = DB::table('plans')->where('stripe_plan', $subscr->stripe_plan)->first(); //return stdclass object
                $band = Auth::user()->band;
                // dd(var_dump($plan), var_dump($subscr), var_dump($banduserSubscr));
                return view('plans.show', compact('plan', 'banduserSubscr','band'));
                }
            }
        // dd($array_id_users_band, $subscr_id, $band_subscr, $today_less_one_year, $id->stripe_plan);
        }
        $plans = Plan::all();
        return view('plans.show', compact('plans'));
    }

    public function show(Plan $plan, Request $request)
    {
        $paymentMethods = $request->user()->paymentMethods();
        $intent = $request->user()->createSetupIntent();

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
