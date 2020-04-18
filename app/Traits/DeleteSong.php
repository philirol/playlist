<?php
namespace App\Traits;
use App\Song;

trait DeleteSong {

    public function deleteSong(Song $song){
        foreach ($song->songsubs as $songsub){ 
            if( $songsub->file !== null ) {
            unlink(storage_path('app/public/'.$songsub->file));            
            }
            $songsub->delete();
        }
        $song->delete(); 
    }

}