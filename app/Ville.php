<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $fillable = [];

    public $timestamps = false;
    
    public function bands()  //relation pas encore établie
    {
        return $this->hasMany('App\Band');
    }

    public function scopeOfDepartement($query, $type)
    {
        return $query->where('ville_departement', $type);
    }
}
