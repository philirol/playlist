<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Profil as ProfilRequest;
use App\{Departement,User,Band};
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $bandname = Band::all();
        return view('user.profil', compact('user', 'bandname'));

    }
    
    public function geog($slug = null)
    {
        $query = Departement::whereSlug($slug)->firstOrFail();
        $villes = $query->scopeOfDepartement()->paginate(30);
        $departements = Departement::all();
        $villes_nbr = $query->count();
        return view('user.newprofil', compact('villes', 'departements', 'slug','villes_nbr'));
    }
    
 /*    public function index()
    {
        $departements = Departement::all()->pluck('departement_code');
        return view('user.profil', compact('departements'));
    } */

    public function newUser($slug = null) //déclaré dans le Handler Exception (route profile)
    {
        $user = Auth::user();
        $bandname = Band::all();
        return view('user.profil', compact('user', 'bandname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        return view('user.show', ['user' => User::findOrFail($id)]);
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
    public function update(ProfilRequest $ProfilRequest, User $user)
    {
        $user->update($ProfilRequest->all());
        return redirect()->route('profil')->with('message', 'Votre profil a bien été modifié');
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
