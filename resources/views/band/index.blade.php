@extends('layouts.app')
@section('css')

@endsection
@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h3>@lang('Liste des goupes') ({{ $bandnumber}})</h3></td>
  </tr>
</table>
</div>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col"><a href="{{ route('band.index', ['sort' => 'id']) }}">id</a></th>
            <th scope="col"><a href="{{ route('band.index', ['sort' => 'bandname']) }}">@lang('Groupe')</a></th>
            <th scope="col">Stock</th>
            <th scope="col"><a href="{{ route('band.index', ['sort' => 'users_count']) }}">Users</th>
            <th scope="col"><a href="{{ route('band.index', ['sort' => 'songs_count']) }}">Songs</th>
            <th scope="col"><a href="{{ route('band.index', ['sort' => 'created_at']) }}">@lang('Date création')</th>  
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
            <td>{{ Carbon\Carbon::parse($band->created_at)->format('d/m/Y') }}</td> 
        </tr>
        @endforeach 
    <tbody> 
</table>

@endsection
