<?php

namespace App\Http\Controllers;

use App\{User, Band};
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => 'index']);
    }
    
    public function index($slug = null)
    {
        $query = $slug ? Band::whereSlug($slug)->firstOrFail()->users() : User::query();
        $users = $query->oldest('name')->paginate(12);
        $bands = Band::all();
        $users_nbr = $query->count();
        return view('user.index', compact('users', 'bands', 'slug','users_nbr'));
    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);
        $user->band_id == 0 ? $bandname = "PAS DE GROUPE" : $bandname = $user->band->bandname ;
        
        // return view('user.show', ['user' => User::findOrFail($id)]);
        return view('user.show', compact('user', 'bandname'));
    }

    public function edit($id){

    }

    public function destroy($id){
        
    }

    public function create(){
        
    }

    public function store(){
        
    }

    public function update(){
        
    }

    public function band(){
        
    }
}
