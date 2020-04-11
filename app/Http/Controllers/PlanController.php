<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\{Plan,User};
use Carbon\Carbon;
use App\Subscription;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index(){

        if(Auth::check()){
        // On veut savoir s'il y a des membres du groupe de l'user qui ont pris un abonnement:      
        //Pour cela on prend déjà tous les id des users qui appartiennent au groupe, modelKeys en fait un array
        $array_id_users_band = User::where('band_id', Auth::user()->band->id)->get()->modelKeys();

        //puis on vérifie si la colonne user_id de la table subscriptions contient des éléments de cet array avec la méthode whereIn
        //ca nous retourne l'abonnement sous forme d'instance de la classe collection par la méthode get
        //pour la date il faut qu'elle soit supérieure à la date d'aujourd'hui moins un an (abonnement valide)
            if (!empty($subscr_id = DB::table('subscriptions')->whereDate('updated_at','>', Carbon::now()->subYear())->whereIn('user_id',$array_id_users_band)->get())){

            //first utilisé pour transformer la collection en stdclass object. Afin d'utiliser la méthode subscribedToPlan dans la vue
            //on peut utiliser first car de toute façon il n'y aura qu'un abonnement valide par groupe pour le moment
            $subscr = $subscr_id->first();
            // dd(Plan::where('stripe_plan', $subscr->stripe_plan)->first());
                if ($subscr !== null){
                    // dd($subscr);
                //pour retourner l'utilisateur du groupe qui s'est abonné
                $userSubscr = User::find($subscr->user_id);
                $plan = DB::table('plans')->where('stripe_plan', $subscr->stripe_plan)->first();
                $band = Auth::user()->band;
                // dd($plan, $subscr, $userSubscr, $userSubscr);
                // $band_subscr = $subscr_id->isNotEmpty();
                // $today_less_one_year = Carbon::now()->subYear();
                return view('plans.show', compact('plan', 'userSubscr','band'));
                }
            }
        // dd($array_id_users_band, $subscr_id, $band_subscr, $today_less_one_year, $id->stripe_plan);
        }
        //normal script
        $plans = Plan::all();
        return view('plans.show', compact('plans'));
    }

    public function show(Plan $plan, Request $request)
    {
        
        

        //normal script
        $paymentMethods = $request->user()->paymentMethods();
        $intent = $request->user()->createSetupIntent();

        return view('plans.process', compact('plan', 'intent'));
    }


}
