<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Songsub as SongsubRequest;
use App\Songsub;
use App\Song;
use Illuminate\Support\Facades\Auth;

class SongsubController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth')->except(['index','show']);              
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $song = session('song'); //apparemment quand on change de controlleur (song à songsub, on ne récupére pas l'instance song mis en passage de paramètre à la méthode)
        $songsub = Songsub::where('song_id',$song->id)->get();
        return view('songsub.index', compact('songsub', 'song'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sub)
    {
        $songsub = new Songsub;
        $song = session('song');
        return view('songsub.create', compact('song','songsub', 'sub'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SongsubRequest $request)
    {
        // dd($request->songfile->getClientOriginalExtension()); //extension
        // dd($request->songfile->getClientOriginalName()); //name
        // dd($request->songfile->getMimeType());         

        $song = session('song');        
        $songsub = new Songsub;
        $user = Auth::user();
        
        if($request->songfile){   

            $request->validate([ 
                'songfile' => 'required|file|max:1000|
                mimetypes:
                audio/mpeg,
                audio/x-wav,
                audio/x-aac,
                audio/x-flac,
                audio/x-ms-wma,
                audio/x-aiff,
                application/gpx+xml,
                text/plain,
                video/quicktime,
                application/mp4,
                application/msword,
                application/vnd.oasis.opendocument.text,
                application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                application/vnd.oasis.opendocument.spreadsheet,
                application/vnd.oasis.opendocument.graphics,
                image/gif,
                image/x-ms-bm,
                image/jpeg,
                image/png,
                image/tiff,
                application/pdf'
                //https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
                //https://github.com/hhsadiq/laravel-mime-type
            ]);

         /*    $validator = Validator::make($request->all(), [
                'songfile' => [
                    'required'=> 'sélectionner un fichier',
                    'max:1000'=> 'The song must be under 1000', //5000 = 5Mo. Voir php.ini upload_max_filesize (généralement 2M)
                    'mimetypes:audio/mpeg,text/plain,video/quicktime',
                    'mimes:audio/mpeg,text/plain,video/quicktime',
                ],
            ])->validate(); */

            $uploadedFile = $request->file('songfile');
            $filename = 'user' . $user->id . 'song' . $song->id . '-' .time() . '.' . $uploadedFile->getClientOriginalExtension();
            $paths   = $uploadedFile->storeAs('public/songsub', $filename);
            $songsub->file = $paths;            
            $songsub->title = $request->songfile->getClientOriginalName();
        }
        else {
            $validatedData = $request->validate([
                'title' => ['required', 'string', 'max:50'],
                'url' => ['url'],
            ]);
            $songsub->title = $request->title;
            $songsub->url = $request->url;
        }
        
        $songsub->user()->associate($user);
        $songsub->song()->associate($song);
        $songsub->save();
        $countsongsub = Songsub::where('song_id', $song->id)->count();
        
        $song->songsub = $countsongsub;
        $song->save();
        $song->refresh();
        return view('songs.show', compact('song'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
