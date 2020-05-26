<?php

namespace App\Repositories;

use App\Song;

class SongRepository
{
    protected $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }
    
}
