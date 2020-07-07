<?php

namespace App\Repositories;

use App\Media;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as InterventionImage;
use App\Traits\SubscriptionControlTrait;
use App\Http\Controllers\PhotoController;

class PhotoRepository
{
    use SubscriptionControlTrait;
    
    public function store($request){        
    $band= Auth::user()->band;

    $mediafile = $request->file('media');
    $fileSize = $mediafile->getSize();

    if ( Gate::any(['freeupload', 'freePlan'], $fileSize) || $this->BandPlanLimitControl(Auth::user(), $fileSize)){ 

        $filename = 'User' . Auth::user()->id . '-' .time() . '.' . $mediafile->getClientOriginalExtension();
        $path = $mediafile->storeAs($band->slug, $filename, 'public'); //image storing
        
        $mediapath = public_path('storage/'.$band->slug.'/'.$filename);
        
        $mediafileTreated = InterventionImage::make ($mediapath)->widen (300)->encode ();
        // $mediafileTreated = InterventionImage::make($mediapath)->resize(300, 300, function($constraint) {
        //     $constraint->aspectRatio();
        // });
        $mediafileTreated->save($mediapath);
        clearstatcache(); //put that imperatively, if not the size will the one before treatment
        $fileSizeNew = $mediafileTreated->filesize();
        
        $media = new Media;
        $media->title = $request->title;
        $media->description = $request->description;
        $media->name = $path;
        $media->type = 1; //1 for photos, 0 for happenings
        $media->filesize = $fileSizeNew;
        $media->band()->associate($band);      

        $media->touch();
        $message= "L'image a bien été ajoutée.";
        return $message;

        } else {
            $message = "Espace de stockage insuffisant";
            return $message;
        }
    }
}
