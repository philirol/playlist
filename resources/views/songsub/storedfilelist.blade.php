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
<p>Total value of your files: <strong>{{ bcdiv($size1, 1005000, 1) }} Mo</strong> <span class="note">({{ number_format($size1,0, ',', ' ')}} Mo)</span></p>
<p>Your files are :</p>
<table class="table table-striped">
@foreach($songsubs as $item)
<tr class="row1">
  <td>
    <span class="note">{{ $item['title'] }} ({{ number_format($item['filesize'],0, ',', ' ')}} Ko)</span>
  </td> 
  <td>
    @if($item->type == 2)    
    <a href="#" onClick="javascript:vidSwap('{{ asset('storage/' . $item['file'] ) }}'); return false;"><img src="{{asset('images/file2.png')}}" alt="@lang('Jouer dans le lecteur')" title="@lang('Jouer dans le lecteur')"></a>
    @else
    <a href="{{ route('songsub.dwnld', ['songsub' => $item['id']]) }}"><img src="{{asset('images/dwnld.png')}}" width="22" height="22" alt="@lang('Télécharger le fichier')" title="@lang('Télécharger le fichier')"></a>
    @endif
  </td>
</tr> 
 @endforeach
</table>

@endsection
