<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';
  
    protected $fillable = array('file','name','description');

    public function band(){
        return $this->belongsTo(Band::class);
    }
}
