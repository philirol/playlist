<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Songsub;
use App\User;
use App\Song;

class SongRepository
{
    protected $songsub;

    public function __construct(Songsub $songsub)
	{
		$this->songsub = $songsub;
	}

	private function save(Songsub $songsub, User $user)
	{
		$song = session('song');
		$songsub->user()->associate($user);
        $songsub->song()->associate($song);
        $songsub->save();
        $countsongsub = Songsub::where('song_id', $song->id)->count();
        
        $song->songsub = $countsongsub;
        $song->save();
		$song->refresh();
		
		return redirect()->action('SongController@show', ['id' => $song->id]);
	}
	
	public function storeFile($file, Array $songpatch)
	{
		$song = session('song');
        $user = Auth::user();
		
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
                $songpatch['file'] = $paths;            
                $songpatch['title'] = $filename;
                //type 2 files will be treated with html5 audio player (wma, aiff, mid not supported by the player)
                $array_audiofile = ['audio/mpeg','audio/ogg','audio/flac','audio/x-wav','audio/x-flac'];
                in_array($mimeType, $array_audiofile) ? $songpatch['type'] = 2 : $songpatch['type'] = 3;                
  
                // return back()->with('message','Upload Successful.');
            }else{
                return back()->with('message',__('Taille des fichiers limités à 2MB'));
            }
  
          }else{
            return back()->with('message', __('Extension de fichier invalide'));
			}			        
			$songsub = new Songsub;

			$songsub->file = $songpatch['file'];
			$songsub->title = $songpatch['title'];
			$songsub->type = $songpatch['type'];

			$this->save($songsub, $user);	
	}
}	