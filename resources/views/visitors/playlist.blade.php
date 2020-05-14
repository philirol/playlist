@extends('layouts.appvisitors')
@section('content')
<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="Playlist" margbot="3"/>
</div>
<div class="container">
  <table class="table table-striped">
    <tbody id="tablecontents">
      @foreach($songs as $song)
        <tr>
          <td>{{ $song->title }}</td>
        </tr>
      @endforeach
      </tbody>
  </table>
</div>
@endsection