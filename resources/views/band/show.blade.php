@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-auto mr-auto"><h3>{{ $band->bandname }} - Membres</h3></div>
        @if(Auth::check() and Auth::user()->admin)
        <div class="col-auto">
        <a href="{{ route('band.songs', ['band' => $band->id]) }}" class="btn btn btn-primary">@lang('Voir Playlist')</a>
        </div>
        @endif
    </div>
</div>
<hr>
<p class="text-muted font-italic">@lang('Création du groupe le') {{ Carbon\Carbon::parse($band->created_at)->format('d m Y') }} {{-- - {{ $band->ville->ville_nom }} ({{ $band->ville->ville_code_postal }}) --}}</p>
<p><a href="{{ route('band.edit', ['band' => $band->id]) }}">Modification du groupe</a></p>


    {{-- With cards
    @foreach($band->users as $user)
    <div class="card border-info mb-3" style="max-width: 20rem;">
        <h5 class="card-header">{{ $user->name }}</h5>
        <div class="card-body text-info">
            <p class="card-text"><u>{{ $user->email }}</u></p>
            <p class="card-text">Créé le {{ Carbon\Carbon::parse($user->created_at)->format('d m y') }}</p>
            <br>            
        </div>
    </div>
    @endforeach--}}

    @foreach($band->users as $user)
    <div class="card mb-3" style="max-width: 550px;">
        <div class="row no-gutters">
            <div class="col-md-4">
            @if ($user->image)
                <img src="{{ asset('storage/avatars/' . $user->image) }}" alt="user-avatar" class="rounded float-left">
            @else
                <img src="{{ asset('storage/avatars/avatar.png') }}" alt="user-avatar" class="rounded float-left">
            @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <span class="font-weight-bold">{{ $user->name }}</span><br>
                    <span class="note">@lang('Créé le') {{ Carbon\Carbon::parse($user->created_at)->format('d m y') }}</span>
                    <p class="card-text"><u>{{ $user->email }}</u></p>                
                </div>
            </div>
        </div>
    </div>
    @endforeach


<a href="javascript:history.back()" class="btn btn-primary">
<span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')
</a><br>

@endsection

