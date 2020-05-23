@extends('layouts.app')

@section('content')
<div class="bg-secondary rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Groupe inconnu')</h4></td>
  </tr>
</table>
</div>
<br>

<h4 class="text-center">@lang('Désolé, il n\'y a pas de groupe correspondant à ce lien.')</h4>

@endsection