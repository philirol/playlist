<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class BandHelper {

    /* public static function getBand(){
        // Auth::check() ? $band = Auth::user()->band : $bandId = 1;
        Auth::check() ? $band = Auth::user()->band : $band = \App\Band::find(1);
        return $band;
    } */

    public static function getBand(){
        if(!Auth::check()){
            // $band_id = session('band_id', 1); //session('band_id') can be provided by VisitosMiddleware, if not, we give by default the id of the demo group
            $band = \App\Band::find(1);
        } elseif (Auth::check() && !Auth::user()->admin) {
            $band = Auth::user()->band;
        } else {
            // for the admin, we show the playlist of his own band if he doesn't choose another band playlist in admin area to see it.
            // Otherwise We take the value of session(band_id). If it doesn't exist we pass the band_id of the admin as default value
            $band = \App\Band::find(session('band_id', Auth::user()->band_id));
        }
        return $band;
    }
}