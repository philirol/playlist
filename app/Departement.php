<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = ['departement_code'];
    public $timestamps = false;
    protected $primaryKey = 'departement_id';

    
}
