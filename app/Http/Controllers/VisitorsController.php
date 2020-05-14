<?php

namespace App\Http\Controllers;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\{Band, Song};

class VisitorsController extends Controller
{
    /* public function __construct(){
        $this->middleware('members')->only('index');
    } */

    public function index(){  //should be accessible for demo-group
        Auth::check() ? $slug = Auth::user()->band->slug : $slug = 'demo-band';
        
        $url = config('app.url').config('app.visitors_urlslugprefix').$slug;
        return view('visitors.visitors', compact('url'));
    }    

    public function playlist($slug){
        $band = Band::where('slug', $slug)->first();

        // dd(session('band'));
        $songs = Song::where('band_id', $band->id)->orderBy('order', 'ASC')->get();
        // dd($songs);
        return view('visitors.playlist', compact('songs','band'));
    }    

    public function visitBand($id) //pour les users
    {
        // $band = Band::firstWhere('slug',$slug);
        $band = Band::find($id);
        return view('visitors.showband', compact('band'));
    }
    
    public function visitmedias($id){
        $band = Band::find($id);
        $medias = \App\Media::where('band_id',$id)->orderBy('created_at', 'DESC')->get();
        return view('visitors.medias', compact('medias','band'));
    }
}
