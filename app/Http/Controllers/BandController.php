<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Band;

use Illuminate\Http\Request;

class BandController extends Controller
{
    public function construct()
    {
        $this->middleware('admin')->except(['show']); //permet ces fonctions à l'user non authentifié
        $this->middleware('leader')->only(['show','edit','update']);
    }

    public function index()
    {
        /*$bands = DB::table('bands')
        ->orderBy('bandname')
        ->get();*/
        // dd(Gate::allows('index-band'));
        
        $bands = Band::with('ville')->withCount(['songs','users'])->get();        
        return view('band.index', compact('bands'));               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $band = new Band;
        $villes = DB::table('villes')
                            ->select('id', 'ville_nom', 'ville_code_postal')
                            //->whereBetween('id', [1,100])
                            ->orderBy('ville_nom')
                            ->get();
        return view('band.create', compact('band','villes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Band $band)
    {
        return view('band.show', compact('band'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
