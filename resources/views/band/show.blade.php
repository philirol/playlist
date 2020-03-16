@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-auto mr-auto"><h3>{{ $band->bandname }}</h3></div>
        @if(Auth::check() and Auth::user()->admin)
        <div class="col-auto">
        <a href="{{ route('band.songs', ['band' => $band->id]) }}" class="btn btn btn-primary">@lang('Voir Playlist')</a>
        </div>
        @endif
    </div>
</div>
<hr>
<p class="text-muted font-italic">Créé le {{ $band->created_at->format('d/m/Y') }} - {{ $band->ville->ville_nom }} ({{ $band->ville->ville_code_postal }})</p>
<p><a href="{{ route('band.edit', ['band' => $band->id]) }}">Modification du groupe</a></p>
<h3>Les membres :</h3>

    @foreach($band->users as $user)
    <div class="card border-info mb-3" style="max-width: 20rem;">
        <h5 class="card-header">{{ $user->name }}</h5>
        <div class="card-body text-info">
            <p class="card-text">{{ $user->email }}</p>
            <p class="card-text">Créé le {{ $user->created_at->format('d/m/Y') }}</p>
            <br>            
        </div>
    </div>
    @endforeach

<a href="javascript:history.back()" class="btn btn-primary">
<span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')
</a><br>

@endsection

