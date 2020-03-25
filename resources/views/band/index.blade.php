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
<table class="table table-striped">
<caption>Liste des groupes</caption>
    <thead class="thead-dark">
        <tr>
            <th scope="col">id</th>
            <th scope="col">@lang('Groupe')</th>
            <th scope="col">Stock</th>
            <th scope="col">Users</th>
            <th scope="col">Songs</th>
            <th scope="col">@lang('Date création')</th>  
        </tr>
    </thead> 
    <tbody>
        @foreach($bands as $band)
        <tr>
            <th scope="row">{{ $band->id }}</td>
            <td><a href="{{ route('bandByAdmin', $band->id)}}">{{ $band->bandname }}</td>
            <td>{{ $band->sizedir }} ({{ bcdiv($band->sizedir, 1048576, 0) }}Mo)</td>
            <td>{{ $band->users_count }}</td>
            <td>{{ $band->songs_count }}</td>
            <td>{{ $band->created_at->format('d/m/Y') }}</td> 
        </tr>
        @endforeach 
    <tbody> 
</table>

@endsection
