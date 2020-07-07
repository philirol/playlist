<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';
  
    protected $fillable = array('name','type','title','description','filesize');

    public function band(){
        return $this->belongsTo(Band::class);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeType($query)
    {
        return $query->where('type', '>', 1);
    }

}
