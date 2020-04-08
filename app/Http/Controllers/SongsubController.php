<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Songsub as SongsubRequest;
use App\Songsub;
use App\Song;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

class SongsubController extends Controller
{
    public function __construct() 
    {   
        $this->middleware('members')->except(['index','create']);              
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

    public function mainSongsub($main, Songsub $songsub){
        if($main == null){
            $songsub->main = 0;
        } else {
            Songsub::where('song_id', session('band_id', session()->get('song')['id']))
                        ->where('main', 1)
                        ->update(['main' => 0]);
            $songsub->main = 1;
        }
        return $songsub;
    }

    public function stockBandControl($fileSize){
        $bandStorage = Auth::user()->band->sizedir;
        if($bandStorage + $fileSize > 20000000){
            dd($bandStorage + $fileSize);
            return view('band.proposAbon');
        }
    }
    
    public function store(Request $request)
    { 
        $song = session('song');        
        $songsub = new Songsub;
        $this->mainSongsub($request->main, $songsub);
        
        if($request->testfile != null){ 
            
            $this->validatorFile();
            $this->storeFile($songsub);
        /* 
        si je met que "$this->validatorFile();" ca fonctionne mais un fichier d'extension non permise provoque une erreur 
        si je met que "return $this->validatorFile();" le controle des extension fonctionne mais cela fait juste un retour json avec un fichier ok 
        RESOLU avec ->send() ... https://stackoverflow.com/questions/27991837/laravel-return-redirect-inside-function    
        */
        }

        if($request->testfile == null){
            $this->validatorLink();
            $songsub->url = $request->url;
            $songsub->title = $request->title;
            $songsub->type = 1;
        }
        
        $songsub->user()->associate(Auth::user());
        $songsub->song()->associate($song);

        //comptage des songsubs et update du nombre dans le champ songsub de la table song
        $countsongsub = Songsub::where('song_id', $song->id)->count(); 
        $countsongsub == null ? $songsub->main = 1 : ''; //main = 1 pour le       
        $song->songsub = $countsongsub + 1;
        $songsub->save();

        $song->save();
        $song->refresh();
        // $bandStorage = $song->band->sizedir;
        // dd($bandStorage);
        return redirect()->action('SongController@show', ['id' => $song->id]);
    }

    private function storeFile($songsub){
        $user = Auth::user();          
        $song = session('song');           
        //source de ce qui suit : https://makitweb.com/how-to-upload-a-file-in-laravel/
        $file = request()->file('file');         
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath(); //if needed
        $fileSize = $file->getSize();
        if(Gate::allows('upload', $fileSize)){ //see AuthServiceProvider for storage limit                    
            $mimeType = $file->getMimeType();
            $valid_extension = array('mpga','mp3','ogg','wav','flac','mid','mp4','png','gif','jpg','jpeg','txt','xls','xlsx','ods','doc','docx','odt','pdf','gpx','gp3','gpa4','gp5','mov');
            $maxFileSize = 32000000; //32MB
            
            if(in_array(strtolower($extension),$valid_extension)){            
                if($fileSize <= $maxFileSize){               
                    $filename = preg_replace('/[^a-zA-Z0-9\-\._]/','', $filename); 
                                
                    $withoutExt = pathinfo($filename, PATHINFO_FILENAME); //suppression de l'extension for that final formatting : filename-time.ext
                    $filenameToStorage = $withoutExt . '-' .time() . '.' . $extension;                
                    $band_folder = $user->band->slug;
                    $paths = $file->storeAs($band_folder, $filenameToStorage, 'public');
                    $songsub->file = $paths;         
                    $songsub->title = $filename;
                    //type 2 files will be treated with html5 audio player (wma, aiff, mid not supported by the player)
                    $array_audiofile = ['audio/mpeg','audio/ogg','audio/flac','audio/x-wav','audio/x-flac','video/quicktime'];
                    in_array($mimeType, $array_audiofile) ? $songsub->type = 2 : $songsub->type = 3;  
                    return $songsub;
                    
                } else {
                    return redirect()->action('SongController@show', ['id' => $song->id])->with('messageDanger', __('Taille des fichiers limités à 32MB'))->send();
                }
            } else {
                return redirect()->action('SongController@show', ['id' => $song->id])->with('messageDanger', __('Extension de fichier invalide'))->send();
            } 
        } else {
            return redirect()->route('proposAbon')->send();
        } 
    }

    public function download(Songsub $songsub)
    {
        $filename = $songsub->file;
        $path = public_path().'/storage/'.$filename;
        // dd($path);
        return response()->download($path);
    }

    public function show(Songsub $songsub)
    {        
        dd('show function');
    }
    
    public function edit(Songsub $songsub)
    {
        $song = session('song');
        return view('songsub.edit', compact('songsub','song'));
    }

    private function validatorFile()
    {
           return request()->validate([
            'file' => 'required|max:32000', //ne pas utiliser size. Mettre pour max la valeur de config php post_max_size Sinon entre les 2 valeurs il met un msg trop générique
            // 'main' => 'required'
            'user_id' => 'exists:users,id',
            'song_id' => 'exists:songs,id'
        ]);
    }
    
    private function validatorLink()
    {
           return request()->validate([
            'title' => ['required', 'string', 'max:30'],
            'url' => ['url'],
            'user_id' => 'exists:users,id',
            'song_id' => 'exists:songs,id'
            // 'main' => 'required'
        ]);
    }
    
    public function update(Request $request, Songsub $songsub)
    {
        $this->mainSongsub($request->main, $songsub);       

        if($request->testfile != null){                        
            if($request->file){
                $this->validatorFile();
                $this->destroyFile($songsub);
                $this->storeFile($songsub);
            }
            $songsub->update();
        }
        else{
            $songsub->update($this->validatorLink());
        }
        $song = session('song');
        return redirect()->action('SongController@show', ['id' => $song->id]);
    }

    private function destroyFile(Songsub $songsub){
            unlink(storage_path('app/public/'.$songsub->file));
    }
    
    public function destroy(Songsub $songsub)
    {
        if ($songsub->type > 1){ // if > 1 this is a file, not a link
            $this->destroyFile($songsub);
        }
        $songsub->delete();
        DB::table('songs')->where('id', $songsub->song_id)->update(['songsub' => $songsub->song->songsub - 1]); //removing 1 to the songsub number
        
        return back()->with('message', __('L\'élément a bien été supprimé'));
    }
    
}
