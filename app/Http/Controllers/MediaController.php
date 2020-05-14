<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MediaRepository;
use App\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    protected $repository;
    
    public function __construct(MediaRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('members')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::check() ? $band_id = Auth::user()->band->id : $band_id = 1;

        $band = \App\Band::find($band_id);

        $medias = Media::where('band_id',$band_id)->orderBy('created_at', 'DESC')->get();
        return view('medias.index', compact('medias','band'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medias.create');
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

        return redirect('medias')->with($messagetype,__($message));
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
        return view('medias.edit', compact('media'));
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
        $media->update($this->params($request));

        return redirect()->route('medias.index')->with('message',__('Modification effectuée'));
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
        // dd($media);
        unlink(storage_path('app/public/'.$media->name));
        $media->delete();
        return redirect()->route('medias.index')->with('message',__('Suppression effectuée'));
    }
}
