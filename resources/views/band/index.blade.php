@extends('layouts.app')
@section('css')

@endsection
@section('content')
<div class="p-3 bg-{{config('app.appflagcolor')}} rounded-lg text-white">
      <div class="d-inline-block"><h3>@lang('Liste des goupes') ({{ $bandnumber}})</h3></div>
</div>
<br>
<table class="table table-sm">
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
            <td>{{ substr(number_format($band->sizedir,0, ',', ' '), 0, -4) }} Ko</td>
            <td>{{ $band->users_count }}</td>
            <td>{{ $band->songs_count }}</td>
            <td>{{ Carbon\Carbon::parse($band->created_at)->format('d/m/y') }}</td> 
        </tr>
        @endforeach 
    <tbody> 
</table>

@endsection
