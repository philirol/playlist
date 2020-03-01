<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Ville;
use App\Band;
use App\Song;

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

    public function department(){
        $arrayId = Departement::all()->pluck('departement_code')->implode(' - ');
    }
}
