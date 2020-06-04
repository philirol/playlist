@extends('layouts.appvisitors')

@section('content')
<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="Playlist" margbot="3"/>
@section('players')
@endsection
  <table class="table table-striped">
      @foreach($songs as $song)
        <tr>
          <td>{{ $song->title }}</td>
          <td>
            @foreach($song->songsubs as $songsub)        
              @if($songsub->main == 1)
              
                @switch($songsub->type)
                    @case(1)
                        @if( preg_match('/(vimeo)/', $songsub->url ) || preg_match('/(yout)/', $songsub->url ))
                        <a href="{{ route('playerVisitor', [$songsub,$band]) }}"><img src="{{asset('images/ytb.png')}}" alt="Icon player" title="click to load in player"></a>
                        @else
                        <a href="{{ $songsub->url }}" target="_blank"><img src="{{asset('images/www.png')}}" width="22" height="22" alt="Icon player" title="click to load in player"></a>
                        @endif
                        @break

                    @case(2)
                        <a href="#" onClick="javascript:vidSwap('{{ asset('storage/' . $songsub->file) }}'); return false;"><img src="{{asset('images/file2.png')}}" alt="Icon player" title="click to load video in player"></a>
                        @break

                @endswitch

              @endif          
            @endforeach
          </td>
        </tr>
      @endforeach
  </table>

@endsection