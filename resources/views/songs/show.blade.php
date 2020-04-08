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
@section('media')
@endsection
@if($song->songsubs) 
    @lang('Éléments joints au morceau'):
    <table class="table table-striped">
        @foreach($song->songsubs as $songsub)
                <tr class="row1" data-id="{{ $songsub->id }}">
                    <td>
                        <a href="{{ route('songsub.edit', $songsub->id) }}">{{ $songsub->title  }}</a> @if($songsub->main == 1) * @endif                        
                    </td>
                        @switch($songsub->type)
                            @case(1)
                            @if( preg_match('/(vimeo)/', $songsub->url ) || preg_match('/(yout)/', $songsub->url ))
                            <td>
                            <a href="{{ route('playin', ['songsub' => $songsub , 'song' => $song->id]) }}"><img src="{{asset('images/ytb.png')}}" alt="Ouvrir dans le lecteur" title="@lang('Ouvrir dans le lecteur')"></a>
                            </td>
                            @else
                            <td>&nbsp;</td>
                            @endif
                            <td>
                                <a href="{{ $songsub->url }}" target="_blank"><img src="{{asset('images/www.png')}}" width="22" height="22" alt="@lang('Ouvrir dans site web')" title="@lang('Ouvrir dans site web')"></a>
                            </td>
                            @break

                            @case(2)
                            <td>
                            <a href="#" onClick="javascript:vidSwap('{{ asset('storage/' . $songsub->file) }}'); return false;"><img src="{{asset('images/file2.png')}}" alt="Play" title="@lang('Jouer dans le lecteur')"></a>
                            </td> 
                            <td>
                                <a href="{{ route('songsub.dwnld', ['songsub' => $songsub->id]) }}"><img src="{{asset('images/dwnld.png')}}" width="22" height="22" alt="@lang('Télécharger')" title="@lang('Télécharger')"></a>
                            </td>
                            @break

                            @default
                            <td>&nbsp;</td>
                            <td>
                                <a href="{{ route('songsub.dwnld', ['songsub' => $songsub->id]) }}"><img src="{{asset('images/dwnld.png')}}" width="22" height="22" alt="@lang('Télécharger')" title="@lang('Télécharger')"></a>
                            </td>
                        @endswitch
                        <td>
                            <form action="{{ route('songsub.destroy', ['songsub' => $songsub->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <div class="col-md-4">
                                    <div class="login-go-div">
                                        <input type="image" src="{{asset('images/trash2a.png')}}" class="login-go"
                                            onmouseover="this.src='{{asset('images/trash2b.png')}}'"
                                            onmouseout="this.src='{{asset('images/trash2a.png')}}'" title="@lang('Supprimer')"/>
                                    </div>
                                </div>           
                            </form>                    
                        </td>
                </tr> 
         @endforeach
    </table>
    <span class="note">(*)@lang('élément en liste principale')</span>
@endif    
<div class="py-4">    
<a href="{{ route('songsub.create','lk') }}" class="btn btn-info">@lang('Ajout lien')</a>
<a href="{{ route('songsub.create','fl') }}" class="btn btn-info">@lang('Ajout fichier')</a>
{{--<a href="{{ action('SongController@index', '1') }}" class="btn btn-primary">@lang('Retour Playlist')</a>--}}
<a href="{{ action('SongController@index', session('list')) }}" class="btn btn-primary">@lang('Retour '){{ __(session('listname')) }}</a>
</div> 
@endsection
