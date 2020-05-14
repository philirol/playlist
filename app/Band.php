<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

//testgit
class Band extends Model
{
    protected $fillable = ['bandname', 'slug']; 
    public $incrementing = false;
    protected $appends = array('sizedir');
    
    
    public function songsubs()
    {
        return $this->hasMany(Songsub::class);
    }
    
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function medias()
    {
        return $this->hasMany(Media::class);
    }
    
    public function getSizedirAttribute()
    {
        return $this->getSizedir();  
    }

    private function getSizedir()
    {
        $dir = Storage::disk('public')->getAdapter()->getPathPrefix().$this->slug;
        $size = $this->folderSize($dir);
        return $size;
    }

    private function folderSize($dir)
    {
        $size = 0;
        foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : folderSize($each);
        }
        return $size;
    }

  
}
