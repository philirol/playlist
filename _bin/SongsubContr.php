<?php

public function store(SongsubRequest $request)
    { 
        // dd($request->songfile->getClientOriginalExtension()); //extension
        // dd($request->songfile->getClientOriginalName()); //name
        // dd($request->songfile->getMimeType());         

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
  
               // File upload location
                
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
        $songsub->save();
        $countsongsub = Songsub::where('song_id', $song->id)->count();
        
        $song->songsub = $countsongsub;
        $song->save();
        $song->refresh();
        // return view('songs.show', compact('song'));
        return redirect()->action('SongController@show', ['id' => $song->id]);
    }



    //old store function
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