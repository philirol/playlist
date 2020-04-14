<?php

namespace App\Policies;

use App\User;
use App\Songsub;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;

class SongsubPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any songsubs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the songsub.
     *
     * @param  \App\User  $user
     * @param  \App\Songsub  $songsub
     * @return mixed
     */
    public function view(User $user, Songsub $songsub)
    {
        //
    }

    /**
     * Determine whether the user can create songsubs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, $fileSize)
    {
        if(Auth::check()){
            $array_id_users_band = User::where('band_id', Auth::user()->band->id)->get()->modelKeys();
            $condition = DB::table('subscriptions')->whereDate('updated_at','>', Carbon::now()->subYear())->whereIn('user_id',$array_id_users_band)->get()->isNotEmpty();
            // dd($condition);
            return $condition;
            $bandStorage = $user->band->sizedir;
            return $bandStorage + $fileSize < 40000000 ; // 10000000 = 10Mo
        }
    }

    /**
     * Determine whether the user can update the songsub.
     *
     * @param  \App\User  $user
     * @param  \App\Songsub  $songsub
     * @return mixed
     */
    public function update(User $user, Songsub $songsub)
    {
        //
    }

    /**
     * Determine whether the user can delete the songsub.
     *
     * @param  \App\User  $user
     * @param  \App\Songsub  $songsub
     * @return mixed
     */
    public function delete(User $user, Songsub $songsub)
    {
        //
    }

    /**
     * Determine whether the user can restore the songsub.
     *
     * @param  \App\User  $user
     * @param  \App\Songsub  $songsub
     * @return mixed
     */
    public function restore(User $user, Songsub $songsub)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the songsub.
     *
     * @param  \App\User  $user
     * @param  \App\Songsub  $songsub
     * @return mixed
     */
    public function forceDelete(User $user, Songsub $songsub)
    {
        //
    }
}
