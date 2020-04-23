<?php

namespace App\Http\Controllers;

use App\{User, Band};
use App\Http\Requests\User as UserRequest;
use Illuminate\Support\Facades\Auth;
use Image;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => 'indexByAdmin','customerdestroy']);
        $this->middleware('leader',['only' => 'destroy']);
        $this->middleware('auth');
    }
    
    public function index()
    {
        return $this->show(Auth::user());

    }
    
    public function indexByAdmin($slug, $sort = null)
    {
        if ($slug == 'noband'){
            $slug = null;
            session(['slug' => 'noband']);
        } 
        else session(['slug' => $slug]);
        $query = $slug ? Band::whereSlug($slug)->firstOrFail()->users() : User::query();
        $sort !== null ? $order = $sort : $order = 'name';
        $users = $query->orderBy($order)->get();
        // $users = $query->oldest('name')->paginate(12);
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
        $this->authorize('update', $user);
        return view('user.edit', compact('user'));
    }

    public function destroy(User $user){
        $this->authorize('delete', $user);

        //update items which belonged to the user
        DB::table('songsubs')->where('user_id',$user->id)->update(['user_id' => Auth::user()->id]);
        DB::table('songs')->where('user_id',$user->id)->update(['user_id' => Auth::user()->id]);
        DB::table('subscriptions')->where('user_id',$user->id)->update(['stripe_status' => 'user_deleted']);
        
        $user->delete();
        Stripe::setApiKey(env("STRIPE_SECRET"));
        $customer = \Stripe\Customer::retrieve($user->stripe_id);
        $customer->delete();
        //Stripe Also immediately cancels any active subscriptions on the customer (see API reference)
        return redirect()->route('band.show')->with('message',__('L\'utilisateur a été supprimé'));
    }

    public function customerdestroy($id){ //called from admin area
        Stripe::setApiKey(env("STRIPE_SECRET"));
        $customer = \Stripe\Customer::retrieve($id);
        $customer->delete();
        //Stripe Also immediately cancels any active subscriptions on the customer (see API reference)
        return back()->with('message','Client Stripe supprimé');
    }

    public function create(){
        
    }

    public function store(){
        
    }

    public function update(UserRequest $userRequest, User $user)
    {
        $this->authorize('update', $user);

        $validatedData = $userRequest->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048,dimensions:min_width=300,min_height=300',
            
        ]);

        //image delete before placing the new one
        if(isset($userRequest->image)) {
            if($user->image !== null){
            unlink(storage_path('app/public/avatars/'.$user->image));
            }
            $image = $userRequest->file('image');
            $filename = 'userId' . $user->id . '-' .time() . '.' . $image->getClientOriginalExtension();
            $paths = $image->storeAs('avatars', $filename, 'public'); //image storing
            $user->update(['image' => $filename]); //update bdd field
            $thumbnailpath = public_path('storage/avatars/'.$filename);
            $img = Image::make($thumbnailpath)->resize(150, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
        } 
        
        if ($user->email !== $userRequest->email && $user->stripe_id <> null){
            Stripe::setApiKey(env("STRIPE_SECRET"));
            \Stripe\Customer::update(
                $user->stripe_id,
                [
                    'email' => $userRequest->email,
                ]
            );
        }
        
        $user->update($userRequest->except('image'));

        return redirect()->route('user.index')->with('message', __('Votre profil a été modifié'));
    }

    public function deleteImage(User $user)
    {
        // dd($file_path);
        // Storage::delete('app/public/'.$user->image));
        unlink(storage_path('app/public/avatars/'.$user->image));
        $user->update(['image' => null]);
        return redirect()->route('user.index')->with('message', __('Votre profil a été modifié'));
    }
}
