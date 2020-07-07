<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Band,Song,Media,Story};
use App\Helpers\BandHelper;

class BookController extends Controller
{
    public function geturl(){  //should be accessible for demo-group too
        $slug = BandHelper::getBand()->slug;        
        $url = config('app.url').config('app.visitors_urlslugprefix').$slug;
        return view('book.visitors', compact('url'));
    }
    
    public function getband(){
        return Band::find(session('band')->id);
    }

    public function index($slug){
        $band = Band::where('slug', $slug)->first();
        session()->exists('filetoplaybook') ? $url = session('filetoplaybook')->url : $url = 'https://www.youtube.com/watch?v=6Zv6M2WMY2s';
        return view('book.index', compact('band','url'));
    }

    public function playlist(){
        $band = $this->getband();
        $songs = Song::where('band_id', $band->id)->where('list',1)->orderBy('order', 'ASC')->get();
        session()->exists('filetoplaybook') ? $url = session('filetoplaybook')->url : $url = 'https://www.youtube.com/watch?v=6Zv6M2WMY2s';
        return view('book.playlist', compact('songs','band','url'));
    }    

    public function band()
    {
        $band = $this->getband();
        return view('book.band', compact('band'));
    }

    public function contact()
    {
        $band = $this->getband();
        return view('book.contact', compact('band'));
    }
    
    public function photos(){
        $band = $this->getband();
        $photos = Media::where('band_id',$band->id)->ofType(1)->orderBy('created_at', 'DESC')->get();
        return view('book.photos', compact('photos','band'));
    }

    public function videos(){
        $band = $this->getband();
        $videos = Media::where('band_id',$band->id)->Type()->orderBy('created_at', 'DESC')->get();
        return view('book.videos', compact('videos','band'));
    }
    
    public function story(){
        $band = $this->getband();
        $story = Story::where('band_id',$band->id)->get();
        // dd($story);
        return view('book.story', compact('story','band'));
    }

    public function happenings(){
        $band = $this->getband();
        $happenings = Media::where('band_id',$band->id)->ofType(0)->orderBy('created_at', 'ASC')->get();
        return view('book.happenings', compact('happenings','band'));
    }
}
