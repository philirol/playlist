<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Songsub as SongsubRequest;
use App\Repositories\SongsubRepository;
use App\Songsub;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Traits\SubscriptionControlTrait;
use Illuminate\Support\Facades\Storage;

class SongsubController extends Controller
{
    use SubscriptionControlTrait;    
    protected $songsubRepository;
    
    public function __construct(SongsubRepository $songsubRepository) 
    {   
        $this->middleware('members')->except(['index','create']);   
        $this->songsubRepository = $songsubRepository;           
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

    public function store(Request $request)
    { 
        $song = session('song');        
        $songsub = new Songsub;
        
        $this->mainSongsub($request->main, $songsub);
        
        if($request->testfile != null){ 
            
            $this->validatorFile();
            $this->songsubRepository->storeFile($songsub);
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
        $songsub->touch();

        $song->touch();
        $song->refresh();
        return redirect()->action('SongController@show', [$song->id]);
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
            'file' => 'required|max:100000', //ne pas utiliser size. Mettre pour max la valeur de config php post_max_size Sinon entre les 2 valeurs il met un msg trop générique
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
        $this->authorize('update',$songsub);
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
        return redirect()->action('SongController@show', [$song->id]);
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

    public function storedfilelist(){
        /* $array_id_users_band = User::where('band_id', Auth::user()->band->id)->get()->modelKeys();
        dd($array_id_users_band);
        $bandfiles = DB::table('songsubs')->where('file','<>', NULL)->whereIn('user_id',$array_id_users_band)->get();
        $songsubs = Songsub::all();
        $bandfiles = $songsubs->contains(Songsub::whereIn('user_id', $array_id_users_band)->get());
        dd($bandfiles); */

        $files_with_size = array();
        // $files = Storage::disk('public'). Auth::user()->band->slug;
        $files = Storage::disk('public')->files(Auth::user()->band->slug);
        // dd($files);

        foreach ($files as $key => $file) {
            $files_with_size[$key]['name'] = $file;
            $files_with_size[$key]['size'] = Storage::disk('public')->size($file);
        }
        // dd($files_with_size);
        return view('songsub.storedfilelist', compact('files_with_size'));
    }
    
}
