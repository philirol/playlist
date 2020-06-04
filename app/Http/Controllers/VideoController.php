<?php

namespace App\Http\Controllers;

use App\Helpers\BandHelper;
use Illuminate\Http\Request;
use App\{Media,Band};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Traits\SubscriptionControlTrait;

class VideoController extends Controller
{
    use SubscriptionControlTrait;

    public function __construct()
    {
        $this->middleware('members')->except('index','create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $band = Bandhelper::getBand();
        $medias = Media::where('band_id',$band->id)->Type()->orderBy('created_at', 'DESC')->get();
        return view('videos.index', compact('medias','band'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $media = new Media;
        $request->validate([
            'media' => 'required|max:100000',
            'description' => 'required|string|max:150',
        ]);
               
        $user = Auth::user();
        $band= $user->band;    
        $mediafile = $request->file('media');
        $extension = $mediafile->getClientOriginalExtension();
        $fileSize = $mediafile->getSize();
        $mimeType = $mediafile->getMimeType();

        if($extension == "mp3"){
            $media->type = 3;
        } else {
            $array_audiofile = ['audio/mpeg','audio/ogg','audio/flac','audio/x-wav','audio/x-flac','video/mp4','video/quicktime'];
            in_array($mimeType, $array_audiofile) ? $media->type = 2 : $media->type = 3;
        } // getMimeType sometimes not detect mp3 because of this format
        
        if ( Gate::any(['freeupload', 'freePlan'], $fileSize) || $this->BandPlanLimitControl($user, $fileSize)){               
            
            $valid_extension = array('mpga','mp3','ogg','wav','flac','mp4','mov','avi');
            // dd(ini_get('post_max_size'));
            $maxFileSize = 95000000; //ini_get('post_max_size') renvoie en local "128Mo" 
            
            if(in_array(strtolower($extension),$valid_extension)){            
                if($fileSize <= $maxFileSize){

                    $filename = 'User' . $user->id . '-' .time() . '.' . $mediafile->getClientOriginalExtension();
                    $path = $mediafile->storeAs($band->slug, $filename, 'public');

                    // dd($path);
                    $media->name = $path;
                    $media->description = $request->description;
                    $media->filesize = $fileSize; 
                    //type 2 files will be treated with html5 audio player (wma, aiff, mid not supported by the player)  
                    $this->save($media, $band);
                    
                } else {
                    $message = "Taille des fichiers limités à ".$maxFileSize;
                    $this->redirect($message);
                }
            } else {
                $message = "Extension de fichier invalide";
                $this->redirect($message);
            } 
        } else {
            $message = "Espace de stockage insuffisant";
            $this->redirect($message);
            }
    }

    public function save(Media $media, Band $band){        
        $media->band()->associate($band);        
        $media->band_id = $band->id;
        $media->touch();
        $this->redirect();
    }

    public function redirect($message = null){
        if ($message == null){
            return redirect('videos')->with('message',__('Fichier téléchargé.'))->send();
        } else return redirect('videos')->with('messageDanger', __($message))->send();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = Media::find($id);
        $this->authorize('view', $media);
        return view('videos.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:150',
        ]);
        $media = Media::find($id);
        $this->authorize('update', $media);
        $media->update($this->params($request));
        return redirect()->route('videos.index')->with('message',__('Modification effectuée'));
    }

    private function params(Request $request){
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::find($id);
        $this->authorize('delete', $media);
        // dd($media);
        unlink(storage_path('app/public/'.$media->name));
        $media->delete();
        return redirect()->route('videos.index')->with('message',__('Suppression effectuée'));
    }
}
