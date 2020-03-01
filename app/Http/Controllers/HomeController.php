<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['language']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->admin) {
            return redirect('band');
        }
        return redirect('songs');
    }

    public function language(String $locale)
    {
        $locale = in_array($locale, config('app.locales')) ? $locale : config('app.fallback_locale');

        session(['locale' => $locale]);

        return back();
    }

}
