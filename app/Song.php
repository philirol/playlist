<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['title','url','file','order','list','comments'];
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

    public function getListValue(){
        return $this->list;
    }
    
    public function getListAttribute($attributes)
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
