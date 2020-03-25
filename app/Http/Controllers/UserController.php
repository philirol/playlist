<?php

namespace App\Http\Controllers;

use App\{User, Band};
use App\Http\Requests\User as UserRequest;
use Illuminate\Support\Facades\Auth;
use Image;

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
        $validatedData = $userRequest->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048,dimensions:min_width=300,min_height=300',
            
        ]);

        //image delete before placing the new one
        if($user->image != null) {
            unlink(storage_path('app/public/avatars/'.$user->image));
        }

        $image = $userRequest->file('image');
        
        $user->update($userRequest->all());
        $filename = 'userId' . $user->id . '-' .time() . '.' . $image->getClientOriginalExtension();
        $paths = $image->storeAs('avatars', $filename, 'public'); //image storing
        $user->update(['image' => $filename]); //update bdd field

        $thumbnailpath = public_path('storage/avatars/'.$filename);
        $img = Image::make($thumbnailpath)->resize(150, 150, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);

        return redirect()->route('user.index')->with('message', 'Votre profil a bien été modifié');
    }

    public function deleteImage(User $user)
    {
        // dd($file_path);
        // Storage::delete('app/public/'.$user->image));
        unlink(storage_path('app/public/avatars/'.$user->image));
        $user->update(['image' => null]);
        return back();
    }
}
