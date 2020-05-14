@extends('layouts.app')

@section('content')
<div class="py-3 pl-3 pt-2 pb-3 mb-0 pr-3 bg-{{config('app.appflagcolor')}} rounded-lg text-white">
      <div class="d-inline-block"><h4>{{ $band->bandname }}</h4></div>
      @if(Auth::check() and Auth::user()->admin)
      <div class="d-inline-block float-right"><a href="{{ route('band.songs', [$band]) }}" class="btn btn-primary my-1">@lang('Voir Playlist')</a></div>
      @endif
      <div><h6>@lang('Membres')</h6></div>
</div>
<br>
<p class="text-muted font-italic">@lang('Création du groupe le') {{ Carbon\Carbon::parse($band->created_at)->formatLocalized('%d %B %Y') }} {{-- - {{ $band->ville->ville_nom }} ({{ $band->ville->ville_code_postal }}) --}}</p>
    @can('update', $band)
        <ul class="list-inline">
        <small>
        <li class="list-inline-item"><a href="{{ route('band.edit', ['band' => $band->id]) }}">@lang('Modif nom du groupe')</a></li>
        <li class="list-inline-item"><a href="{{ route('invit.addmember') }}">@lang('Ajouter des musiciens')</a></li>
        <li class="list-inline-item"><a href="{{ route('band.delete') }}">@lang('Supprimer le groupe')</a></li>        
        </small>
        </ul>
    @endcan
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
                    <span class="font-weight-bold">{{ $user->name }}</span>&nbsp;&nbsp;
                    <small class="text-muted">(@lang('Créé le') {{ Carbon\Carbon::parse($user->created_at)->format('d m y') }})</small>
                    <p class="card-text"><u>{{ $user->email }}</u></p>
                    @can('delete',$user)
                    <small><a href="{{ route('user.delete', $user->id) }}">@lang('supprimer')</a></small>
                    @endcan  
                    
                                  
                </div>
            </div>
        </div>
    </div>
    @endforeach

<a href="{{ action('SongController@index', '1') }}" class="btn btn-primary">@lang('Retour Playlist')</a>

@endsection