<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'ville_id';
    public $timestamps = false;
    
    public function bands()  //relation pas encore établie
    {
        return $this->hasMany(Band::class);
    }
}
