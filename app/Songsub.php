<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Songsub extends Model
{
    protected $fillable = ['song_id','user_id','title','url','file','comments'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
