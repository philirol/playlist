<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAdmin;
use App\Mail\ContactLeader;

class ContactController extends Controller
{
    public function create()
    {
        Auth::check() ? $band = Auth::user()->band : $band = 'noband';
        return view('contact.leader', compact('band'));
    } 


    public function contact($id){
        $band = \App\Band::find($id);
        // dd($band);
        return view('visitors.contact', compact('band'));
    }    

    public function mailtoLeader($id)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:100'],
            'message' => ['required', 'string', 'max:400']
        ]);

        $bandleader = \App\User::where('band_id', $id)->where('leader',1)->first();

        Mail::to($bandleader->email)->send(new ContactLeader($data));

        return back()->with('message', 'Votre message a bien été envoyé !');
    }

    public function AdminContactForm($id,$visitor = null)
    {
        $visitor == null ? $visitor = 0 : $visitor = 1;
        return view('contact.admin', compact('visitor'));
    }

    public function mailtoAdmin()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:100'],
            'message' => ['required', 'string', 'max:400']
        ]);

        Mail::to('philirol@hotmail.com')->send(new ContactAdmin($data));

        return back()->with('message', 'Votre message a bien été envoyé !');
    }

}
