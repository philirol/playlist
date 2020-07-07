<?php
namespace App\Http\Controllers;

use App\Helpers\BandHelper;
use Illuminate\Http\Request;
use App\Repositories\HappeningsRepository;
use App\Media;
use Illuminate\Support\Str;

class HappeningsController extends Controller {
    protected $repository;
    
    public function __construct(HappeningsRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('members')->except('index','create');
    }

    public function index()
    {
        $band = Bandhelper::getBand();
        $medias = Media::where('band_id',$band->id)->ofType(0)->orderBy('created_at', 'ASC')->get();
        return view('happenings.index', compact('medias','band'));
    }

    public function create()
    {
        return view('happenings.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'title' => 'string|max:75',
        'media' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048,dimensions:min_width=300,min_height=300',
        'description' => 'nullable|string|max:255',
        ]);
        $message = $this->repository->store($request);
        
        Str::contains($message,'stockage') ? $messagetype = 'messageDanger' : $messagetype = 'message';
        return redirect('happenings')->with($messagetype,__($message));
    }

    public function edit($id)
    {
        $media = Media::find($id);
        $this->authorize('view', $media);
        return view('happenings.edit', compact('media'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
        'media' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048,dimensions:min_width=300,min_height=300',
        'title' => 'string|max:75',
        'description' => 'nullable|string|max:255',
        ]);

        $media = Media::find($id);
        $this->authorize('update', $media);
        $message = $this->repository->update($request, $media);
        Str::contains($message,'stockage') ? $messagetype = 'messageDanger' : $messagetype = 'message';
        return redirect('happenings')->with($messagetype,__($message));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::find($id);
        $this->authorize('delete', $media);
        $media->name != 'happenings-defaults.png' ?? unlink(storage_path('app/public/'.$media->name));
        $media->delete();
        return redirect()->route('happenings.index')->with('message',__('Suppression effectuée'));
    }

    public function deleteposter(Media $media){
        $band = Bandhelper::getBand();
        unlink(storage_path('app/public/'.$media->name));
        $media->update(['name' => 'happenings-default.png', 'filesize' => 0]); //the default png is not taken for the band sizedir
        return redirect()->route('happenings.index')->with('message', __('L\'affiche a été supprimée'));
    }
    
}