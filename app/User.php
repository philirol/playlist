<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
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

    public function donations()
    {               
        return $this->hasMany(Donation::class);
    }

    public function isAdmin(){
        return $this->admin == '1';
    }
 }
