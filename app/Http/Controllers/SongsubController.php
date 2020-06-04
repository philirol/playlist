<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SongsubRepository;
use App\Songsub;
use Illuminate\Support\Facades\DB;
use App\Traits\SubscriptionControlTrait;

class SongsubController extends Controller
{
    use SubscriptionControlTrait;    
    protected $songsubRepository;
    
    public function __construct(SongsubRepository $songsubRepository) 
    {   
        $this->middleware('members')->except(['index','create','edit']);   
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
        $songsub = new Songsub;        
        $this->mainSongsub($request->main, $songsub);
        
        if($request->testfile != null){             
            $this->validatorFile();
            $this->songsubRepository->storeFile($songsub);
            // if( ($this->songsubRepository->storeFile($songsub)) instanceof \App\Songsub)
        }

        if($request->testfile == null){
            $this->validatorLink();
            $this->songsubRepository->storeLink($songsub, $request);
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
        if ($songsub->type > 1){ // if > 1 for a file, not a link
            $this->destroyFile($songsub);
        }
        $songsub->delete();
        DB::table('songs')->where('id', $songsub->song_id)->update(['songsub' => $songsub->song->songsub - 1]); //removing 1 at song table
        
        return back()->with('message', __('L\'élément a bien été supprimé'));
    }   
}
