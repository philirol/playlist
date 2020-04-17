<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

trait SubscriptionControlTrait {
    
    // used in planController too
    private function BandHasValidSubscription() { 
		$array_id_users_band = User::where('band_id', Auth::user()->band->id)->get()->modelKeys(); //modelKeys return an array of all the members of the band
        return DB::table('subscriptions')->whereDate('updated_at','>', Carbon::now()->subYear())->whereIn('user_id',$array_id_users_band)->get(); //return php stdclass object       
    }

    public function BandPlan(){ 
        if($this->BandHasValidSubscription()->isNotEmpty()){  
            $subscr =  $this->BandHasValidSubscription()->first(); //subscr so php stdclass object. first : normally there's jut one valid subscription per band
                $plan = DB::table('plans')->where('stripe_plan', $subscr->stripe_plan)->get();  //$plan so php stdclass object 
        }
        else {
            $plan = DB::table('plans')->where('slug', 'free')->get(); //if non plan, we'll control the bitval of the free one
        }
        return $plan ;
    }

    public function BandPlanLimitControl(User $user, $fileSize){
        $controleStorage = $user->band->sizedir + $fileSize;   
        // dd(var_dump($this->BandPlan()))  ;   
        if (($this->BandPlan()) !== null){
        $plan = $this->BandPlan()->first();
        return $controleStorage < $plan->bitval; //return true if limit not reached
        } else {
            return false;
        }
    }

    public function showPlan(){
        $plan =  $this->BandPlan()->first();
        return view('band.proposAbon', compact('plan'));
    }

}