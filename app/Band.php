<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Band extends Model
{
    protected $fillable = [
        'bandname', 'deposit_file', 'ville_id'
    ];
    
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

     public function getbandnameAttribute($value)
    {
        return strtoupper($value);
    }

    public function ville() //relation pas encore établie
    {
        return $this->belongsTo('App\Ville');
    }
}
