<?php

namespace App\Http\Controllers;

use App\Helpers\BandHelper;
use Illuminate\Http\Request;
use App\Repositories\PhotoRepository;
use App\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    protected $repository;
    
    public function __construct(PhotoRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('members')->except('index','create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $band = Bandhelper::getBand();
        $medias = Media::where('band_id',$band->id)->ofType(1)->orderBy('created_at', 'DESC')->get();
        return view('photos.index', compact('medias','band'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required|image|max:2000',
            'description' => 'nullable|string|max:150',
        ]);
        $message = $this->repository->store($request);

        Str::contains($message,'stockage') ? $messagetype = 'messageDanger' : $messagetype = 'message';

        return redirect('photos')->with($messagetype,__($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = Media::find($id);
        $this->authorize('view', $media);
        return view('photos.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'nullable|string|max:255',
        ]);

        $media = Media::find($id);
        $this->authorize('update', $media);
        $media->update($this->params($request));

        return redirect()->route('photos.index')->with('message',__('Modification effectuée'));
    }

    private function params(Request $request){
        return $request->all();
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
        unlink(storage_path('app/public/'.$media->name));
        $media->delete();
        return redirect()->route('photos.index')->with('message',__('Suppression effectuée'));
    }
}
