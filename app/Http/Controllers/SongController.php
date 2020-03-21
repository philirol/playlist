<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use App\Songsub;
use App\Band;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Song as SongRequest;
use Illuminate\Database\Eloquent\Builder;


class SongController extends Controller
{
    private $NbrParPage = 13;
    private $user;

    public function __construct()
    {
    
        $this->middleware('auth')->except(['index','update_order','show']); 
        //permet ces fonctions à l'user non authentifié
        // $this->middleware('admin');
        //only : fonctions qui seront non permises aux users non admin
        
        
    }  
    
    public function index(Request $request, $list = null){
        
/*      $songs = Song::with('user')->paginate($this->NbrParPage);
        $songs = Song::all(); 
        $songs = Song::with('users')->get(); //sans pagination  
*/  
        
        
            // Auth::user()->can('viewAny', Song::class);
            if(!Auth::check()){
                $band_id = 1; //pour groupe démo
            } elseif(Auth::check() && !Auth::user()->admin) {
                $band_id = Auth::user()->band->id;
            } else {// pour admin, s'il choisi pas un groupe on lui montre sa playlist par défaut. Si l'admin créé un morceau il sera toujours mis dans sa playlist à lui et pas sur laquelle il est positionné
                $band_id = session('band_id', Auth::user()->band_id); 
            }       
/*       Utilisation de la relation
        $songs = Song::with('band')->get(); //toutes les songs
        $songs = Song::select('*')->where('band_id', '=', $band_id)->get(); //ok
        //$songs = Band::find($user->band->id)->songs; //marche pas avec orderBy
*/
        $list == null ? $list = '1': $list = $list; 

        $list == 1 ? session(['listname' => 'Playlist']) : session(['listname' => 'Projets']);

        $bandname = Band::find($band_id)->bandname;        
     
        $songs = Song::where([
            ['band_id', $band_id],
            ['list', $list]
            ])->orderBy('order', 'ASC')->get();
            
        return view('songs.index', compact('songs', 'bandname'));  

    }

    public function create()
    {   
        $song = new Song; //création d'une song vide pour formulaire de création        
        return view('songs.create', compact('song'));
    }

    public function store(SongRequest $songRequest)
    {      
        // dd($songRequest->list);
        $song = Song::create($songRequest->all());
        $user = Auth::user();
        $song->band_id = $user->band->id; 
        $song->user_id = $user->id;
        //le morceau a pu être créé avant car band_id et user_id sont nullable dans la table
        $this->list($song);
        // return redirect()->route('playlist', [$songRequest->list])->with('message', __('Le nouveau morceau a bien été créé!'));
        return view('songs.show', compact('song'))->with('message', __('Le nouveau morceau a bien été créé!'));

    }

    public function update(SongRequest $songRequest, Song $song) 
    {    
        /*
        array_search($song->list, $song->getListOptions() renvoie la clé de la liste d'avant
        on compare cette clé avec la liste de destination et si le morceau change de liste, on met son order à 0 de manière à ce que le morceau en question soit le premier de la nouvelle liste
       */
        if( array_search($song->list, $song->getListOptions()) <> intval($songRequest->list)){
            $songRequest['order'] = 0 ;
        }      
        $song->update($songRequest->all()); 
        return redirect()->route('playlist', [$songRequest->list])->with('message', __('Le morceau a bien été mis à jour!'));
        // return view('songs.show', compact('song'))->with('message', __('Le morceau a bien été mis à jour!'));
    }

    private function list(Song $song)
    {
        if (!request('list')){
            $song->update(['list' => false]);
        } else { $song->update(['list' => true]); }
    }

    public function show(Song $song) //remplacé par le model binding ici présent
    {               
        $this->authorize('view', $song);
        session(['song' => $song]); //sert pour show songsub
        return view('songs.show', compact('song'));        
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
        foreach ($song->songsubs as $songsub){ 
            if( $songsub->file != null ) {
            unlink(storage_path('app/public/'.$songsub->file));            
            }
            $songsub->delete();
        }
        $song->delete();        
        return redirect()->route('playlist', [array_search($song->list, $song->getListOptions())])->with('message', __('Le morceau a bien été supprimé!'));
    }
}
