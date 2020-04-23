<?php

namespace App\Policies;

use App\User;
use App\Songsub;
use Illuminate\Auth\Access\HandlesAuthorization;

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
        // return $user->band_id === $songsub->song->band_id;
    }

    /**
     * Determine whether the user can create songsubs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
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
        return $user->band_id === $songsub->song->band_id;
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
