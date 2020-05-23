<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\NewUser;
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
        $this->middleware(['auth','verified'])->except(['language']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $user->nconnex ++;
        $user->update();
        if($user->admin) {
            return redirect()->route('band.index', ['sort' => 'id']); //sorted by id by default
        }
        return redirect('songs')->with('message', __('Bienvenue sur Playlist ').$user->name.' !');
    }

    public function language(String $locale)
    {
        $locale = in_array($locale, config('app.locales')) ? $locale : config('app.fallback_locale');

        session(['locale' => $locale]);

        return back();
    }
}
