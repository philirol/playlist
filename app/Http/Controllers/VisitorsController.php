<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\{Band, Song};

class VisitorsController extends Controller
{
    /* public function __construct(){
        $this->middleware('members');
    } */

    public function index(){
        Auth::check() ? $slug = Auth::user()->band->slug : $slug = 'demo-band';
        
        $url = config('app.url').config('app.visitors_urlslugprefix').$slug;
        return view('visitors.visitors', compact('url'));
    }    

    public function playlist($slug){
        $band = Band::where('slug', $slug)->first();
        $songs = Song::where('band_id', $band->id)->orderBy('order', 'ASC')->get();
        // dd($songs);
        return view('visitors.playlist', compact('songs', 'band'));
    }    

    public function showBand($id) //pour les users
    {
        // $band = Band::firstWhere('slug',$slug);
        $band = Band::find($id);
        return view('visitors.showband', compact('band'));
    }
}
