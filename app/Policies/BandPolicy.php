<?php

namespace App\Policies;

use App\User;
use App\Band;
use Illuminate\Auth\Access\HandlesAuthorization;

class BandPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability){
        if($user->isAdmin()){
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any bands.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the band.
     *
     * @param  \App\User  $user
     * @param  \App\Band  $band
     * @return mixed
     */
    public function view(User $user, Band $band)
    {
        return $band->id === $user->band_id;
    }

    /**
     * Determine whether the user can create bands.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the band.
     *
     * @param  \App\User  $user
     * @param  \App\Band  $band
     * @return mixed
     */
    public function update(User $user, Band $band)
    {
        if($band->id == $user->band_id && $user->leader == 1) return true;
    }

    /**
     * Determine whether the user can delete the band.
     *
     * @param  \App\User  $user
     * @param  \App\Band  $band
     * @return mixed
     */
    public function delete(User $user, Band $band)
    {
        if($band->id == $user->band_id && $user->leader == 1) return true;
    }

    /**
     * Determine whether the user can restore the band.
     *
     * @param  \App\User  $user
     * @param  \App\Band  $band
     * @return mixed
     */
    public function restore(User $user, Band $band)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the band.
     *
     * @param  \App\User  $user
     * @param  \App\Band  $band
     * @return mixed
     */
    public function forceDelete(User $user, Band $band)
    {
        //
    }
}
