@extends('layouts.appvisitors')

@section('content')
<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="Accueil" margbot="3"/>
@section('players')
@endsection
<p>Bienvenue sur le site du groupe {{$band->bandname}}.</p>
<p>Vous pouvez naviguer dans les différents menus : Playlist, Le groupe, les Photos...pour découvrir le groupe.</p>
<p>
  Dans la playlist, si les icones <img src="{{asset('images/ytb.png')}}" alt="Icon player" title="click to load in player"> ou <img src="{{asset('images/file2.png')}}" alt="Icon player" title="click to load video in player"> apparaissent pour les morceaux, vous pouvez cliquer dessus pour charger les démos dans les lecteurs intégrés dans la page.
</p>
<p>Bonne découverte ;-)</p>

@endsection