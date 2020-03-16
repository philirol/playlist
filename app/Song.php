<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['band_id','title','url','file','order','list','comments'];
    //laisser list dans fillable sinon il se met pas à jour en update

    //protected $guarded = [];

    public function band()
    {
        return $this->belongsTo(Band::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function songsubs()
    {
        return $this->hasMany(Songsub::class);
    }

    protected $attributes = ['list' => 1]; 
    /*
    Attribut de list donné par défaut pour une new song (sinon list=NULL).
    Voir vidéo nord coders n°16 à 17:25
    https://www.youtube.com/watch?v=MfiCKl8UGpI&list=PLeeuvNW2FHVgvC-PdSfi309DbDMoEswiT&index=16
    On le positionne sur "Playlist" par défaut dans le formulaire
    */
    public function getListValue(){
        return $this->list;
    }
    
    public function getListAttribute($attributes)
    //vidéo 14 nord coders 14 à 10:30. Sinon https://laravel.com/docs/master/eloquent-mutators
    {
        return $this->getListOptions()[$attributes];
    }

    public function getListOptions()
    {
        return [
            '0' => 'Projets',
            '1' => 'Playlist'        
        ];
    } 
    
    

}
