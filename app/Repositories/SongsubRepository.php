<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Songsub;
use App\Traits\SubscriptionControlTrait;

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
        
        if ( Gate::any(['freeupload', 'freePlan'], $fileSize) || $this->BandPlanLimitControl($user, $fileSize)){               
            $mimeType = $file->getMimeType();
            $valid_extension = array('mpga','mp3','ogg','wav','flac','mid','mp4','png','gif','jpg','jpeg','txt','xls','xlsx','ods','doc','docx','odt','pdf','gpx','gp3','gpa4','gp5','mov');
            // dd(ini_get('post_max_size'));
            $maxFileSize = 95000000; //ini_get('post_max_size') renvoie en local "128Mo" 
            
            if(in_array(strtolower($extension),$valid_extension)){            
                if($fileSize <= $maxFileSize){               
                    $filename = preg_replace('/[^a-zA-Z0-9\-\._]/','', $filename); 
                    $filename = substr($filename, 0, 40);
                                
                    $withoutExt = pathinfo($filename, PATHINFO_FILENAME); //suppression de l'extension for that final formatting : filename-time.ext
                    $filenameToStorage = $withoutExt . '-' .time() . '.' . $extension;                
                    $band_folder = $user->band->slug;
                    $paths = $file->storeAs($band_folder, $filenameToStorage, 'public');
                    $songsub->file = $paths;         
                    $songsub->title = $filename;
                    //type 2 files will be treated with html5 audio player (wma, aiff, mid not supported by the player)
                    $array_audiofile = ['audio/mpeg','audio/ogg','audio/flac','audio/x-wav','audio/x-flac','video/mp4','video/quicktime'];
                    in_array($mimeType, $array_audiofile) ? $songsub->type = 2 : $songsub->type = 3;  
                    return $songsub;
                    
                } else {
                    return redirect()->action('SongController@show', ['id' => $song->id])->with('messageDanger', __('Taille des fichiers limités à ').$maxFileSize)->send();
                }
            } else {
                return redirect()->action('SongController@show', ['id' => $song->id])->with('messageDanger', __('Extension de fichier invalide'))->send();
            } 
        } else {
            return redirect()->action('SongsubController@showPlan')->with('messageDanger', __('Espace de stockage insuffisant'))->send();
        } 
    }
	
}	


/* utilisation de send()
si je met que "$this->validatorFile();" ca fonctionne mais un fichier d'extension non permise provoque une erreur 
si je met que "return $this->validatorFile();" le controle des extension fonctionne mais cela fait juste un retour json avec un fichier ok 
RESOLU avec ->send() ... https://stackoverflow.com/questions/27991837/laravel-return-redirect-inside-function    
*/