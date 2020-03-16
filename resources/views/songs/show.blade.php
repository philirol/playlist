@extends('layouts.app')

@section('content')
@include('includes.songhead')

    <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-secondary my-3">@lang('Editer')</a>
    <form action="{{ route('songs.destroy', ['song' => $song->id]) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">@lang('Supprimer')</button>
        <a href="{{ route('songsub.create','lk') }}" class="btn btn-info">@lang('Ajout lien')</a>
        <a href="{{ route('songsub.create','fl') }}" class="btn btn-info">@lang('Ajout fichier')</a>
    </form>
    <hr>

@if($song->songsubs)
    <table class="table table-striped">
        @foreach($song->songsubs as $songsub)
            <tr class="row1" data-id="{{ $songsub->id }}">
                <td><a href="">{{ $songsub->title  }}</a></td>
                @if($songsub->file)
                <td><img src="{{asset('images/folder.png')}}" alt="files attached" title=""></td>      
                @else<td>&nbsp;</td>
                @endif
                @if($songsub->url)
                <td><a href="{{ $songsub->url }}" target="_blank"><img src="{{asset('images/ytb.png')}}" alt="logo youtube" height="22" width="33" title="@lang('Aller sur le lien')"></a></td>
                @else<td>&nbsp;</td>
                @endif
            </tr>
         @endforeach
    </table> 
@endif
@endsection