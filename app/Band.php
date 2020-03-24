<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Band extends Model
{
    protected $fillable = ['bandname']; 
    public $incrementing = false;
    
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
