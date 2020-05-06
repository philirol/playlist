@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Liste des fichiers')</h4></td>
  </tr>
</table>
</div>
@section('media')
@endsection
<p>Total value of your files: <strong>{{ bcdiv($size1, 1000000, 1) }} Mo</strong> <span class="note">({{ number_format($size1,0, ',', ' ')}} Mo)</span></p>
<table class="table table-striped">
@foreach($songsubs as $songsub)
<tr class="row1">
  <td>
    <span class="note">{{ $songsub['title'] }} ({{ number_format($songsub['filesize'],0, ',', ' ')}} Ko)</span>
  </td> 
  <td>
    @if($songsub->type == 2)    
    <a href="#" onClick="javascript:vidSwap('{{ asset('storage/' . $songsub['file'] ) }}'); return false;"><img src="{{asset('images/file2.png')}}" alt="@lang('Jouer dans le lecteur')" title="@lang('Jouer dans le lecteur')"></a>
    @else
    <a href="{{ route('songsub.dwnld', ['songsub' => $songsub['id']]) }}"><img src="{{asset('images/dwnld.png')}}" width="22" height="22" alt="@lang('Télécharger le fichier')" title="@lang('Télécharger le fichier')"></a>
    @endif
  </td>
  <td>
    <span class="note">{{ Carbon\Carbon::parse($songsub['created_at'])->format('d/m/Y') }}</span>
  </td>
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
{{--
<td> <a href="{{ route('songsub.destroy', ['songsub' => $songsub->id]) }}"><img src="{{asset('images/trash2a.png')}}" class="login-go"
                    onmouseover="this.src='{{asset('images/trash2b.png')}}'"
                    onmouseout="this.src='{{asset('images/trash2a.png')}}'" title="@lang('Supprimer')"/></a>
                   
</td>
--}}
</tr> 
 @endforeach
</table>
<p><a href="javascript:history.back()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')</a></p>

@endsection
