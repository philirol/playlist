@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>Playlist de {{ $bandname }}</h4></td>
  </tr>
</table>
</div>
<table class="table table-striped">
  <tbody id="tablecontents">
    @foreach($songs as $song)
      <tr>
        <td>{{ $song->title }}</td>
      </tr>
    @endforeach
    </tbody>
</table>
@endsection