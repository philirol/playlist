@extends('layouts.app')

@section('content')

<x-flag-page position="left" type="{{config('app.appflagcolor')}}" page="{{__('Gestion de votre abonnement)}}" margbot="3"/>

<div class="py-2 row justify-content-center">
    <div class="col-md-8">
        <p>@lang('Votre abonnement a bien été supprimé.')</p><br>
        <a href="{{ action('SongController@index', '1') }}" class="btn btn-outline-dark">@lang('Retour Playlist')</a>
    </div>
</div>

@endsection
