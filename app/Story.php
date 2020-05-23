<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'story';

    protected $fillable = ['text'];

    public function band()
    {
        return $this->belongsTo(Band::class);
    }
}
