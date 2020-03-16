<?php

namespace App\Http\Controllers;

use App\{User, Band};
use App\Http\Requests\User as UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => 'indexByAdmin']);
        $this->middleware('auth');
    }
    
    public function index()
    {
        return $this->show(Auth::user());

    }
    
    public function indexByAdmin($slug = null)
    {
        $query = $slug ? Band::whereSlug($slug)->firstOrFail()->users() : User::query();
        $users = $query->oldest('name')->paginate(12);
        $bands = Band::all();
        $users_nbr = $query->count();
        return view('user.index', compact('users', 'bands', 'slug','users_nbr'));
    }
    
    public function show(User $user)
    {

        return view('user.show', compact('user'));
    }
    
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function destroy($id){
        
    }

    public function create(){
        
    }

    public function store(){
        
    }

    public function update(UserRequest $userRequest, User $user)
    {
        $user->update($userRequest->all());
        $this->storeImage($user);
        return redirect()->route('user.index')->with('message', 'Votre profil a bien été modifié');
    }

    private function storeImage(User $user)
    {
        if(request('image')){
            $filename = 'userId' . $user->id . '-' .time() . '.' . request('image')->getClientOriginalExtension();
            $user->update([
                'image' => $filename->store('avatars', 'public') //stockage de la photo dans public/avatars
            ]);
        }
    }

    public function deleteImage(User $user)
    {
        // dd($file_path);
        // Storage::delete('app/public/'.$user->image));
        unlink(storage_path('app/public/'.$user->image));
        $user->update(['image' => null]);
        return back();
    }
}
