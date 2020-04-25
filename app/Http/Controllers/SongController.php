<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use App\Songsub;
use App\Band;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Song as SongRequest;
use App\Notifications\SongNotif;
use Illuminate\Database\Eloquent\Builder;
use PDF;
use App\Traits\DeleteSong;
use Illuminate\Support\Facades\Notification;


class SongController extends Controller
{
    use DeleteSong;
    private $NbrParPage = 13;
    private $user;

    public function __construct()
    {    
        $this->middleware('members')->except(['index','update_order','show','printPlaylist','edit','create']); 
        //permet ces fonctions à l'user non authentifié
        // $this->middleware('admin');
        //only : fonctions qui seront non permises aux users non admin    
    }  

    private function chechBandId(){
        if(!Auth::check()){
            $band_id = 1; //pour groupe démo
        } elseif (Auth::check() && !Auth::user()->admin) {
            $band_id = Auth::user()->band->id;
        } else {
            // for the admin, we show the playlist of his own banf if he doesn't choose another band playlist in admin area.
            // We take de value of session(band_id). If it doesn't exist we pass the band_id of the admin as default value
            $band_id = session('band_id', Auth::user()->band_id);
        }
        return $band_id;
    }
    
    public function index($list = null){

        $band_id = $this->chechBandId();           

        // list = null at the welcome, we show the playlist by default, if not we take the value of the choice in nav bar and we store it the session for 
        if($list == null && !session()->exists('list')) { // coming from welcome
            session(['list' => 1]);
            $list = 1;
        } elseif ($list == null && session()->exists('list')) {  //coming from route play
            $list = session('list');
        } else {
            session(['list' => $list]); //coming from choice nav bar ($list not null)
        }

        $list == 1 ? session(['listname' => 'Playlist']) : session(['listname' => 'Projets']);
        
        $bandname = Band::find($band_id)->bandname;        
     
        $songs = Song::where([
            ['band_id', $band_id],
            ['list', $list ]
            ])->orderBy('order', 'ASC')->with('songsubs')->get();
        
        /* $urlDefault = $songs::find(1)->songsubs()->find(1)->get('url');
        dd($urlDefault); */
            
        session()->exists('filetoplay') ? $url = session('filetoplay')->url : $url = 'https://www.youtube.com/watch?v=6Zv6M2WMY2s';

        return view('songs.index', compact('songs', 'bandname', 'url'));
    }

    public function create()
    {   
        $song = new Song; //création d'une song vide pour formulaire de création        
        return view('songs.create', compact('song'));
    }

    public function store(SongRequest $songRequest)
    {
        $song = Song::create($songRequest->all());
        $user = Auth::user();
        $song->band_id = $user->band->id; 
        $song->user_id = $user->id;
        //le morceau a pu être créé avant car band_id et user_id sont nullable dans la table
        $this->list($song);
        return redirect()->route('playlist', [$songRequest->list])->with('message', __('Le nouveau morceau a bien été créé!'));
        // return view('songs.show', compact('song'))->with('message', __('Le nouveau morceau a bien été créé!'));
    }

    public function mailtomembers(Song $song, $mailtomembers){
        if ($mailtomembers !== null){
            $users = Auth::user()->band->users;
            Notification::send($users, new SongNotif($song, $users));
        }
    }

    public function update(SongRequest $songRequest, Song $song) 
    {    
        $this->authorize('update', $song); //the members of the band are only authorized
        
        // array_search(...) get the key of the list the song was
        // Order putted at first position if the song change of list      
        if( array_search($song->list, $song->getListOptions()) <> intval($songRequest->list)){
            $songRequest['order'] = 0 ;
        }      
        $song->update($songRequest->all()); 
        $this->mailtomembers($song, $songRequest->mailtomembers);
        return redirect()->route('playlist', [$songRequest->list])->with('message', __('Le morceau a bien été mis à jour!'));
        // return view('songs.show', compact('song'))->with('message', __('Le morceau a bien été mis à jour!'));
    }

    private function list(Song $song)
    {
        if (!request('list')){
            $song->update(['list' => false]);
        } else { $song->update(['list' => true]); }
    }

    public function show(Song $song)
    {               
        if($song->band->slug !== 'demo-band') $this->authorize('view', $song);
        session(['song' => $song]); //sert pour show songsub
        
        session()->exists('filetoplay') ? $url = session('filetoplay')->url : $url = 'https://www.youtube.com/watch?v=GuDgvbpVQD4';
        return view('songs.show', compact('song', 'url'));        
    }

    public function edit(Song $song)
    {
        $band = $song->band;
        return view('songs.edit', compact('song','band'));
    }

    public function update_order(Request $request)
    {
        $songs = Song::all();
        foreach ($songs as $song) {
            foreach ($request->order as $order) {
                if ($order['id'] == $song->id) {
                    $song->update(['order' => $order['position']]);
                }
            }
        }        
        return response('Update Successfully.', 200);
    }

    public function destroy(Song $song)
    {      
        $this->deleteSong($song);   
        return redirect()->route('playlist', [array_search($song->list, $song->getListOptions())])->with('message', __('Le morceau a bien été supprimé!'));
    }

    public function printPlaylist()
    {
        $band_id = $this->chechBandId();
        
        $data = Song::where([
            ['band_id', $band_id],
            ['list', 1 ]
            ])->orderBy('order', 'ASC')->get();

            $bandname = Band::find($band_id)->bandname;

        $pdf = PDF::loadView('songs.print_playlist', compact('data', 'bandname'));  
        
        return $pdf->download('medium.pdf');
    }
    
}
