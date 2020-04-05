<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['uid','user_id','email'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
