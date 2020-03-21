@extends('layouts.app')

@section('content')
@include('includes.songhead')

    <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-secondary my-3">@lang('Editer')</a>
    <form action="{{ route('songs.destroy', ['song' => $song->id]) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">@lang('Supprimer')</button>
    </form>
    <hr>

@if($song->songsubs) 
    <p>@lang('Liens / Fichiers attachés') :</p> 
    <table class="table table-striped">
        @foreach($song->songsubs as $songsub)
            {{--@if($songsub->main == 0)--}}
                <tr class="row1" data-id="{{ $songsub->id }}">
                    <td>
                        <a href="{{ route('songsub.edit', $songsub->id) }}">{{ $songsub->title  }} (id {{ $songsub->id  }})</a> @if($songsub->main == 1) * @endif                        
                    </td>
                    @if($songsub->type == 2)
                    <td>
                    {{-- <img src="{{asset('images/folder.png')}}" alt="files attached" title=""> --}}
                    <audio controls src="{{ asset('storage/' . $songsub->file) }}">Your browser does not support the <code>audio</code> element.</audio>
                    </td>      
                    @elseif($songsub->type == 1)
                    <td>
                    <a href="{{ $songsub->url }}" target="_blank"><img src="{{asset('images/ytb.png')}}" alt="logo youtube" title="@lang('Aller sur le lien')"></a>
                    </td>
                    @elseif($songsub->type == 3)
                    <td>
                    <a href="{{ route('songsub.dwnld', ['songsub' => $songsub->id]) }}" title="@lang('Télécharger le fichier')">Document</a>
                    </td>
                    @endif
                    <td>
                    <form action="{{ route('songsub.destroy', ['songsub' => $songsub->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <div class="col-md-4">
                    <div class="login-go-div">
                        <input type="image" src="{{asset('images/trash2a.png')}}" class="login-go"
                            onmouseover="this.src='{{asset('images/trash2b.png')}}'"
                            onmouseout="this.src='{{asset('images/trash2a.png')}}'"/>
                    </div>
                </div>           
                    </form>
                    
                    </td>
                </tr> 
            {{--@endif --}}
         @endforeach
    </table>
@endif    
        
<a href="{{ route('songsub.create','lk') }}" class="btn btn-info">@lang('Ajout lien')</a>
<a href="{{ route('songsub.create','fl') }}" class="btn btn-info">@lang('Ajout fichier')</a>
<a href="{{ action('SongController@index', '1') }}" class="btn btn-primary">@lang('Retour Playlist')</a>
@endsection