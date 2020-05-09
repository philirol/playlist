<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class VisitorsController extends Controller
{
    public function __construct(){
        $this->middleware('members');
    }

    public function index(){
        $band = Auth::user()->band;
        $slug = $band->slug;
        $url = config('app.url').config('app.visitors_urlslugprefix').$slug;
        return view('visitors', compact('url'));
    }
}
