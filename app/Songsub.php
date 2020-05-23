<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Songsub extends Model
{
    protected $fillable = ['main','title','url','file','comments'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    public function band()
    {
        return $this->belongsTo(Band::class);
    }

    public function scopeType($query)
    {
        return $query->where('type', '>', 1);
    }

/*     public function scopeUserId($query){
        $array_id_users_band = User::where('band_id', Auth::user()->band->id)->get()->modelKeys();
    } */

    public function getFileSize(){ //old, replace by the value filesize in db
        return Storage::size($this->file);
    }

}
