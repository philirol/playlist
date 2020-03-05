<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Band extends Model
{
    protected $fillable = ['id', 'bandname','slug', 'deposit_file', 'ville_id']; 
    public $incrementing = false;
    
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function ville() //relation pas encore établie car table pas migrée avec schéma (il me semble)
    {
        return $this->belongsTo(Ville::class);
    }

     public function getbandnameAttribute($value)
    {
        return strtoupper($value);
    }

    
}
