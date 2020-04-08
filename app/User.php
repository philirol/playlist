<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    protected $fillable = ['band_id', 'name', 'leader', 'admin', 'email', 'password', 'image'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
    
    public function songsubs()
    {
        return $this->hasMany(Songsub::class);
    }

    public function band()
    {               
        return $this->belongsTo(Band::class);
    }

    public function invitations()
    {               
        return $this->hasMany(Invitation::class);
    }

    public function isAdmin(){
        return $this->admin == '1';
    }


 }
