<?php

namespace App\Http\Controllers;
use App\Ville;

class VilleController extends Controller
{
    public function construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        //$villes = DB::table('villes')->orderBy('id')->get();        
        $villes = Ville::has('bands')->withCount('bands')->get();        
        return view('ville.index', compact('villes'));
    }
}
