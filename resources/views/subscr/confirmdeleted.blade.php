@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Gestion de votre abonnement')</h4></td>
  </tr>
</table>
</div>

<div class="py-2 row justify-content-center">
    <div class="col-md-8">
        <p>@lang('Votre abonnement a bien été supprimé.')</p><br>
        <a href="{{ action('SongController@index', '1') }}" class="btn btn-outline-dark">@lang('Retour Playlist')</a>
    </div>
</div>

@endsection
