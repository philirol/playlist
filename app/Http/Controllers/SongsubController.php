<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Songsub as SongsubRequest;
use App\Songsub;
use App\Song;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SongsubController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth')->except(['index','show']);              
    }
    
    public function index()
    {
        $song = session('song'); //apparemment quand on change de controlleur (song à songsub, on ne récupére pas l'instance song mis en passage de paramètre à la méthode)
        $songsub = Songsub::where('song_id',$song->id)->get();
        return view('songsub.index', compact('songsub', 'song'));
    }

    public function create($sub)
    {
        $songsub = new Songsub;
        $song = session('song');
        return view('songsub.create', compact('song','songsub', 'sub'));
    }

    public function store(SongsubRequest $request)
    { 
        $song = session('song');        
        $songsub = new Songsub;
        $user = Auth::user();
        
        if($request->testfile != null){   

            $validatedData = $request->validate([
                'file' => 'required',                
            ]);
            //source de ce qui suit : https://makitweb.com/how-to-upload-a-file-in-laravel/
            $file = $request->file('file');        

            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            

            $valid_extension = array('mp3','ogg','wav','flac','mid','mp4','png','gif','jpg','jpeg','txt','xls','xlsx','ods','doc','docx','odt','pdf','gpx','gp3','gpa4','gp5');
            $maxFileSize = 2000000; //2MB

            // Check file extension
        if(in_array(strtolower($extension),$valid_extension)){

            // Check file size
            if($fileSize <= $maxFileSize){
  
               $filenameToStorage = 'user' . $user->id . 'song' . $song->id . '-' .time() . '.' . $extension;
                $band_folder = $user->band->slug;
                $paths = $file->storeAs($band_folder, $filenameToStorage, 'public');
                $songsub->file = $paths;            
                $songsub->title = $filename;
                //type 2 files will be treated with html5 audio player (wma, aiff, mid not supported by the player)
                $array_audiofile = ['audio/mpeg','audio/ogg','audio/flac','audio/x-wav','audio/x-flac'];
                in_array($mimeType, $array_audiofile) ? $songsub->type = 2 : $songsub->type = 3;
                
  
                // return back()->with('message','Upload Successful.');
            }else{
                return back()->with('message',__('Taille des fichiers limités à 2MB'));
            }
  
          }else{
            return back()->with('message', __('Extension de fichier invalide'));
            }
  
        }
            
        else { //si lien
            $validatedData = $request->validate([
                'title' => ['required', 'string', 'max:50'],
                'url' => ['url'],
            ]);
            $songsub->title = $request->title;
            $songsub->type = 1;
            $songsub->url = $request->url;
        }
        
        $songsub->user()->associate($user);
        $songsub->song()->associate($song);
        // $songsub->save();

        //comptage des songsubs et update du nombre dans le champ songsub de la table song
        $countsongsub = Songsub::where('song_id', $song->id)->count(); 
        $countsongsub == null ? $songsub->main = 1 : ''; //main = 1 pour le       
        $song->songsub = $countsongsub + 1;
        $songsub->save();

        $song->save();
        $song->refresh();
        // return view('songs.show', compact('song'));
        return redirect()->action('SongController@show', ['id' => $song->id]);
    }

    public function download(Songsub $songsub)
    {
        $filename = $songsub->file;
        $path = public_path().'/storage/'.$filename;
        // dd($path);
        return response()->download($path);
    }

    public function show(Song $song)
    {
        
        
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy(Songsub $songsub)
    {
        if ($songsub->type > 1){ // if > 1 this is a file, not a link
            unlink(storage_path('app/public/'.$songsub->file));
        }
        $songsub->delete();
        DB::table('songs')->where('id', $songsub->song_id)->update(['songsub' => $songsub->song->songsub - 1]); //removing 1 to the songsub number
        
        return back()->with('message', 'Élément supprimé.');
    }
}
