@extends('layouts.app')

@section('content')
<x-flag-page position="center" type="{{config('app.appflagcolor')}}" page="{{__('Partie visiteurs')}}" margbot="3"/>

<div class="text-center">
    <p>Transmettre le lien ci-dessous pour présenter le book de votre groupe :</p> 
    <p><a href="{{ $url }}" target="_blank">{{$url}}</a></p>
    
</div>
<div class="col-md-6 py-4">
    <p>
        Votre book montrera :
        <ul>
            <li>Votre playlist,</li>
            <li>le groupe et ses membres,</li>
            <li>la possibilité d'imprimer la playlist,</li>
            <li>votre story</li>
            <li>vos photos</li>
            <li>vos vidéos</li>
            <li>un formulaire de contact pour envoyer un mail au leader,</li>
        </ul>
    </p>


</div>
@endsection