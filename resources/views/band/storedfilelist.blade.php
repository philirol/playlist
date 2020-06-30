@extends('layouts.app')

@section('content')
<x-flag-page position="left" type="{{config('app.appflagcolor')}}" page="{{__('Liste des fichiers')}}" margbot="3"/>
<div class="jumbotron note">
  @lang('Poids total des fichiers') : {{ substr(number_format(($size2a + $size2b),0, ',', ' '), 0, -4) }} Ko (bdd)
   <!-- - {{ substr(number_format($size1,0, ',', ' '), 0, -4) }} Ko (dossier du groupe) -->
<br />
  @lang('Volume total disponible') : {{ substr(number_format(($limitUpload),0, ',', ' '), 0, -4) }} Ko<span class="note"> (plan {{$planName}})</span>
  </div>
<p>Fichiers Playlist & Projets : <strong>{{ substr(number_format($size2a,0, ',', ' '), 0, -4) }} Ko</strong></p>
<table class="table table-sm">
  @foreach($songsubs as $songsub)
    <tr class="row1">
      <td>
        <span class="note">
          <a href="#" data-toggle="tooltip" title="{{$songsub->song->title}}">{{ $songsub['title'] }}</a>
          ({{ substr(number_format($songsub['filesize'],0, ',', ' '), 0, -4) }} Ko)
        </span>
      </td> 
      <td width="10%">
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

<br>

<p>@lang('Fichiers pour le Book') : <strong> {{ substr(number_format($size2b,0, ',', ' '), 0, -4) }} Ko</strong></p>
<table class="table table-sm">
  @foreach($medias as $media)
    <tr class="row1">
      <td>
        <span class="note">
        @empty ($media['description']) @lang('media sans description') @else {{ substr($media['description'],0,30) }} @endempty          
        ({{ substr(number_format($media['filesize'],0, ',', ' '), 0, -4) }} Ko)
        </span>
      </td>
      <td width="10%">
        <form action="#" method="POST" style="display: inline;">
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
<br>
<p>
  <a href="javascript:history.back()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')</a>
</p>

@endsection
