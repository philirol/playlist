<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Songsub;
use App\Traits\SubscriptionControlTrait;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class SongsubRepository
{
    protected $songsub;
    use SubscriptionControlTrait;

    public function __construct(Songsub $songsub)
	{
		$this->songsub = $songsub;
	}

    public function storeFile(Songsub $songsub){
        $user = Auth::user();
        $song = session('song');       
        //source de ce qui suit : https://makitweb.com/how-to-upload-a-file-in-laravel/
        $file = request()->file('file');         
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath(); //if needed
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        if($extension == "mp3"){
            $songsub->type = 2;
        } else {
            $array_audiofile = ['audio/mpeg','audio/ogg','audio/flac','audio/x-wav','audio/x-flac','video/mp4','video/quicktime'];
            in_array($mimeType, $array_audiofile) ? $songsub->type = 2 : $songsub->type = 3;
        } // getMimeType sometimes not detect mp3 because of this format
        
        if ( Gate::any(['freeupload', 'freePlan'], $fileSize) || $this->BandPlanLimitControl($user, $fileSize)){               
            
            $valid_extension = array('mpga','mp3','ogg','wav','flac','mid','mp4','png','gif','jpg','jpeg','txt','xls','xlsx','ods','doc','docx','odt','pdf','gpx','gp3','gpa4','gp5','mov');
            // dd(ini_get('post_max_size'));
            $maxFileSize = 95000000; //ini_get('post_max_size') renvoie en local "128Mo" 
            
            if(in_array(strtolower($extension),$valid_extension)){            
                if($fileSize <= $maxFileSize){               
                    $filename = preg_replace('/[^a-zA-Z0-9\-\._]/','', $filename); 
                    $filename = substr($filename, 0, 40);
                                
                    $withoutExt = pathinfo($filename, PATHINFO_FILENAME); ////handy method pathinfo() of PHP that take the filename without extension
                    $filenameToStorage = $withoutExt . '-' .time() . '.' . $extension;            
                    $band_folder = $user->band->slug;
                    // dd($tempPath);
                    $paths = $file->storeAs($band_folder, $filenameToStorage, 'public');
                    // dd($paths);
                    $songsub->file = $paths;         
                    $songsub->title = $filename;
                    $songsub->filesize = $fileSize; 
                    //type 2 files will be treated with html5 audio player (wma, aiff, mid not supported by the player)  
                    $this->save($songsub);
                    
                } else {
                    $message = "Taille des fichiers limités à ".$maxFileSize;
                    $this->redirect($song, $message);
                }
            } else {
                $message = "Extension de fichier invalide";
                $this->redirect($song, $message);
            } 
        } else {
            $message = "Espace de stockage insuffisant";
            $this->redirect($song, $message);
            } 
    }

    public function storeLink(Songsub $songsub, Request $request){
        $songsub->url = $request->url;
        $songsub->title = $request->title;
        $songsub->type = 1;
        $this->save($songsub);
    }

    public function save(Songsub $songsub){
        $song = session('song');        
        
        $songsub->user()->associate(Auth::user());
        $songsub->song()->associate($song);
        
        $songsub->band_id = Auth::user()->band_id;

        //comptage des songsubs et update du nombre dans le champ songsub de la table song
        $countsongsub = Songsub::where('song_id', $song->id)->count(); 
        $countsongsub == null ? $songsub->main = 1 : ''; //main = 1 pour le       
        $song->songsub = $countsongsub + 1;
        $songsub->touch();

        $song->touch();
        $song->refresh();
        $this->redirect($song);
    }

    public function redirect($song, $message = null){
        if ($message == null){
            return redirect()->route('songs.show', [$song])->send();
        } else return redirect()->route('songs.show', [$song])->with('messageDanger', __($message))->send();
    }
}	


/* utilisation de send()
si je met que "$this->validatorFile();" ca fonctionne mais un fichier d'extension non permise provoque une erreur 
si je met que "return $this->validatorFile();" le controle des extension fonctionne mais cela fait juste un retour json avec un fichier ok 
RESOLU avec ->send() ... https://stackoverflow.com/questions/27991837/laravel-return-redirect-inside-function    
*/