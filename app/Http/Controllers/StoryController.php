<?php

namespace App\Http\Controllers;

use App\Helpers\BandHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Story;

class StoryController extends Controller
{
    /* public function __construct()
    {
        $this->authorizeResource(Story::class, 'story');
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $band = BandHelper::getBand();
        $story = $band->story;
        return view('story.index', compact('story'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('story.create');
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
            'text' => 'required|string|max:10000',
        ]);
        $story = new Story;
        $story->text = $request->text;
        $band = BandHelper::getBand();

        $story->band()->associate($band);        
        $story->band_id = $band->id;
        $story->touch();
        return redirect('story');
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
        $story = Story::find($id);
        $this->authorize('view', $story);
        // dd($story);
        return view('story.edit', compact('story'));
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
            'text' => 'nullable|string|max:10000',
        ]);
        $story = Story::find($id);
        $this->authorize('update', $story);
        $story->update($this->params($request));
        return redirect()->route('story.index')->with('message',__('Modification effectuée'));
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
        $story = Story::find($id);
        $this->authorize('delete', $story);
        $story->delete();
        return redirect()->route('story.index')->with('message',__('Suppression effectuée'));
    }
}
