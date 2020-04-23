@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Abonnement')</h4></td>
  </tr>
</table>
</div>

<div class="py-2 row justify-content-center">
    <div class="col-md-8">
        @if(Auth::check())
        <p>En choisissant une formule d'abonnement, votre groupe pourra disposer d'une capacité de stockage plus importante pour le téléchargement de fichiers.</p>
        <p class="note">By choosing a subscription plan, the band will dispose of more capacity storage for files uploading.</p>
        <br>
        <a href="{{ route('plans.show') }}" class="btn btn-primary">@lang('Continuer')</a>
        <a href="{{ action('SongController@index', '1') }}" class="btn btn-outline-primary">@lang('Retour Playlist')</a>

        @else
 
        <p>Pour profiter des formules d'abonnement vous permettant d'avoir plus d'espace de stockage, merci de vous <a href="{{ route('login') }}">inscrire</a> ou de vous <a href="{{ route('register') }}">connecter</a>.</p>
        <p class="note">You must be connected for subscription plans, allowing you to dispose of more stockage capacity for your audio files and others.</p> 
        
        @endif
    </div>
</div>

@endsection