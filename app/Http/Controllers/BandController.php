<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Band;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Band as BandRequest;

use Illuminate\Http\Request;

class BandController extends Controller
{

    public function index()
    {
        $bands = Band::withCount(['songs','users'])->get(); 
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
    public function showByAdmin(Band $band) //pour l'admin avec choix du groupe, provenant de band.index
    {
        
        // dd($band->bandname);
        return view('band.show', compact('band'));
    }

    public function show() //pour les users
    {
        Auth::check() ? $band = Auth::user()->band : $band = Band::find(1);
        return view('band.show', compact('band'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Band $band)
    {        
        // $departement = Departement::all();
        // $ville = Ville::where('id', $band->ville_id)->get(); //Villes en suspens
        return view('band.edit', compact('band'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BandRequest $BandRequest, Band $band)
    {
        $band->update($BandRequest->all());
        return redirect()->route('band.show')->with('message', 'Le groupe a bien été modifié');
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
