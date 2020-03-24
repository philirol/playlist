@extends('layouts.app')
@section('css')

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-auto mr-auto"><h3>@lang('Liste des groupes')</h3></div>
        <div class="col-auto">
        <a href="{{ route('band.create') }}" class="btn btn-outline-dark">@lang('Créer un groupe')</a>
        </div>

    </div>
</div>
<br>
<div class="container-fluid">
  <div class="row" style="font-weight:bold;">
        <div class="rounded-left col-sm-1 bg-secondary" style="padding-top:15px"><p>id</p></div>
        <div class="col-sm-3 bg-secondary" style="padding-top:15px"><p>@lang('Groupe')</p></div>
        <div class="col-sm-1 bg-secondary" style="padding-top:15px"><p>@lang('Utilisateurs')</p></div>
        <div class="col-sm-1 bg-secondary" style="padding-top:15px"><p>@lang('Morceaux')</p></div>
        <div class="col-sm-4 bg-secondary" style="padding-top:15px"><p>@lang('Ville')</p></div>
        <div class="rounded-right col-sm-2 bg-secondary" style="padding-top:15px"><p>@lang('Date création')</p></div>  
    </div>
    @foreach($bands as $band)
    <div class="row">
        <div class ="col-sm-1 bg-light"><p style="margin-top:15px;"><p>{{ $band->id }}</p></div>
        <div class ="col-sm-3 bg-light"><p style="margin-top:15px;"><a href="{{ route('bandByAdmin', $band->id)}}">{{ $band->bandname }}</a></p></div>
        <div class ="col-sm-1 bg-light"><p style="margin-top:15px;">{{ $band->users_count }}</p></div>
        <div class ="col-sm-1 bg-light"><p style="margin-top:15px;">{{ $band->songs_count }}</p></div>
        <div class ="col-sm-4 bg-light"><p style="margin-top:15px;">{{ $band->ville_nom }}</p></div>
        <div class ="col-sm-2 bg-light"><p style="margin-top:15px;">{{ $band->created_at->format('d/m/Y') }}</p></div>  
    </div>
    @endforeach  
</div>
@endsection