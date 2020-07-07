<?php

namespace App\Repositories;

use App\Media;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as InterventionImage;
use App\Traits\SubscriptionControlTrait;
use App\Http\Controllers\HappeningsController;

class HappeningsRepository
{
    use SubscriptionControlTrait;
    
    public function store($request){ 
    
        $band= Auth::user()->band;

        if (!$request->hasFile('media')){
            $path = 'happenings-default.png';
            $fileSize = 0;
            $message = "L'évènement à été créé.";
        } else {
            $mediafile = $request->file('media');
            $fileSize = $mediafile->getSize();

            if ( Gate::any(['freeupload', 'freePlan'], $fileSize) || $this->BandPlanLimitControl(Auth::user(), $fileSize)) { 

                $filename = 'User' . Auth::user()->id . '-' .time() . '.' . $mediafile->getClientOriginalExtension();
                $path = $mediafile->storeAs($band->slug, $filename, 'public'); //image storing
                
                $mediapath = public_path('storage/'.$band->slug.'/'.$filename);
                
                $mediafileTreated = InterventionImage::make ($mediapath)->widen(500)->encode ();
                // $mediafileTreated = InterventionImage::make($mediapath)->resize(300, 300, function($constraint) {
                //     $constraint->aspectRatio();
                // });
                $mediafileTreated->save($mediapath);
                clearstatcache(); //put that imperatively, if not the size will the one before treatment
                $fileSize = $mediafileTreated->filesize();
                $message = "L'évènement à été créé.";

                } else {
                    $message = "L'évènement à été créé. Votre affiche n'a pas été prise en compte : espace de stockage insuffisant";
                    $path = 'happenings-default.png';
                    $fileSize = 0;
                }
        }        
                
        $media = new Media;
        $media->title = $request->title;
        $media->description = $request->description;
        $media->name = $path;
        $media->type = 0; //1 for photos, 0 for happenings
        $media->filesize = $fileSize;
        $media->band()->associate($band);      

        $media->touch();
        return $message;
    }

    public function update($request, Media $media){

        $band= Auth::user()->band;

        if (!$request->hasFile('media')){
            $path = 'happenings-default.png';
            $fileSize = 0;
            $message = "L'évènement à été modifié.";
        } else {
            $mediafile = $request->file('media');
            $fileSize = $mediafile->getSize();
            if ( Gate::any(['freeupload', 'freePlan'], $fileSize) || $this->BandPlanLimitControl(Auth::user(), $fileSize)) { 

                $filename = 'User' . Auth::user()->id . '-' .time() . '.' . $mediafile->getClientOriginalExtension();
                $path = $mediafile->storeAs($band->slug, $filename, 'public'); //image storing
                
                $mediapath = public_path('storage/'.$band->slug.'/'.$filename);
                
                $mediafileTreated = InterventionImage::make ($mediapath)->widen(500)->encode ();
                // $mediafileTreated = InterventionImage::make($mediapath)->resize(300, 300, function($constraint) {
                //     $constraint->aspectRatio();
                // });
                $mediafileTreated->save($mediapath);
                clearstatcache(); //put that imperatively, if not the size will the one before treatment
                $fileSize = $mediafileTreated->filesize();
                $message = "L'évènement à été modifié.";

                } else {
                    $message = "L'évènement à été modifié. Votre affiche n'a pas été prise en compte : espace de stockage insuffisant";
                    $path = 'happenings-default.png';
                    $fileSize = 0;
                }                
        }

        $media->title = $request->title;
        $media->description = $request->description;
        $media->name = $path;
        $media->filesize = $fileSize;   
        $media->touch();
        return $message;    
    }
}
