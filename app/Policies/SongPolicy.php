<?php

namespace App\Policies;

use App\User;
use App\Song;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class SongPolicy
{
    use HandlesAuthorization;
    
/*     public function before(User $user, $ability)
    {
        if ($user->isNewuser()) {
            return false;
        }
    } */

    /**
     * Determine whether the user can view any songs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    
    public function viewAny(User $user = null)
    {
        if (is_null($user)) {
            return true;
        }       
        return !$user->band_id == 0;
    }

    /**
     * Determine whether the user can view the song.
     *
     * @param  \App\User  $user
     * @param  \App\Song  $song
     * @return mixed
     */
    public function view(User $user = null, Song $song = null)
    {
        if (is_null($user)) {
            return true;
        }       
        return !$user->band_id == 0;
    }

    /**
     * Determine whether the user can create songs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the song.
     *
     * @param  \App\User  $user
     * @param  \App\Song  $song
     * @return mixed
     */
    public function update(User $user, Song $song)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the song.
     *
     * @param  \App\User  $user
     * @param  \App\Song  $song
     * @return mixed
     */
    public function delete(User $user, Song $song)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the song.
     *
     * @param  \App\User  $user
     * @param  \App\Song  $song
     * @return mixed
     */
    public function restore(User $user, Song $song)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the song.
     *
     * @param  \App\User  $user
     * @param  \App\Song  $song
     * @return mixed
     */
    public function forceDelete(User $user, Song $song)
    {
        return true;
    }
}
