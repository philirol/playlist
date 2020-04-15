<?php

namespace App\Providers;
use App\{User,Song,Band,Songsub,Plan};
use App\Policies\SongPolicy;
use App\Policies\SongsubPolicy;
use App\Policies\BandPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Song::class => SongPolicy::class,
        Songsub::class => SongsubPolicy::class,
        Band::class => BandPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gates intialized in SongsubRepository :
        Gate::define('freeupload', function (User $user) { 
            if ($user->band->freeupload){
                return true;
            }        
        });

        Gate::define('freePlan', function (User $user, $fileSize) {
            $controleStorage = $user->band->sizedir;
            $controleStorage = $controleStorage + $fileSize;
            $freeUploadLimit = DB::table('plans')->where('slug', 'free')->value('bitval');
            // dd($freeUploadLimit);
            if ($controleStorage < $freeUploadLimit) {
                return true;
                }
            });            
            
            // Gate::define('CheckPlan', function (User $user, $fileSize) {
            //     $controleStorage = $user->band->sizedir + $fileSize;
            //     // dd($controleStorage);
            //     $array_id_users_band = User::where('band_id', Auth::user()->band->id)->get()->modelKeys();
            //     if (!empty($subscr_id = DB::table('subscriptions')->whereDate('updated_at','>', Carbon::now()->subYear())->whereIn('user_id',$array_id_users_band)->get())){
            //         $subscr = $subscr_id->first();
            //         if ($subscr !== null){
            //             // $plan = Plan::where('stripe_plan', $subscr->stripe_plan)->first();
            //             $plan = DB::table('plans')->where('stripe_plan', $subscr->stripe_plan)->first();
            //             // dd($plan->bitval);
            //             return $controleStorage < $plan->bitval ;
            //         } else {
            //             return false;
            //         }
            //     }    
            // });
        
    }
}
