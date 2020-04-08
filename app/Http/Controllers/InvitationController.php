<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\{Invitation,User};
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function __construct()
    {    
        $this->middleware('leader')->only(['addmember','mailtomember']);   
    }

    public function addmember(){
        $band = Auth::user()->band;
        return view('invit.addmember', compact('band'));
    }
    
    public function mailtomember(){
        $data = request()->validate([
            'email' => 'required|email',
            'message' => 'nullable', 'string',
        ]);
        $data['band_id'] = Auth::user()->band_id;
        $data['leader'] = Auth::user()->name;
        $data['bandname'] = Auth::user()->band->bandname;
        

        $invitations = new Invitation;
        $invitations->email = $data['email'];
        $invitations->uid = Str::uuid();
        $data['url'] = 'https://playlistband.net/inv/'.$invitations->uid;
        $invitations->user_id = Auth::user()->id;

        $invitations->save();
        Mail::to($data['email'])->send(new InvitMail($data));
        return back()->with('message', __('Votre invitation a bien été envoyée!'));
    }

    public function store($uid){ //test http://localhost/playlist_laravel58/public/inv/9d5b629f-2428-423a-8f9e-4b2f05a0ed62

        if( $item = Invitation::where('uid', $uid)->where('confirmed', 0)->first() ){
            $email = $item->email;
            return view('auth.register', compact('item'));
        }
        elseif( $item = Invitation::where('uid', $uid)->where('confirmed', 1)->first() ) {
            return redirect()->route('login')->with('messageDanger', __('Vous avez déjà confirmé votre inscription !')); //if confirmed == 1, we take the user to the login page because he's normally known with a password
        }
        else{
            return redirect()->route('register');
        }

        
    }
}
