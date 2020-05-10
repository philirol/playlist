@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Partie visiteurs')</h4></td>
  </tr>
</table>
</div>
<div class="text-center">
    <p>Transmettre le lien ci-dessous pour présenter votre groupe : <br><span class="note">(cliquez dessus pour voir la partie visiteurs.)</span></p> 
    <p><a href="{{ $url }}" target="_blank">{{$url}}</a></p>
    
</div>
<div class="col-md-6 py-4">
    <p>
        Ce mini-site montrera :
        <ul>
            <li>Votre playlist,</li>
            <li>le groupe et ses membres,</li>
            <li>la possibilité d'imprimer la playlist,</li>
            <li>un lien vers le formulaire de contact (c'est l'adresse mail du leader qui en sera destinataire),</li>
            <li>un lien vers votre album de photos et vidéos.</li>
        </ul>
    </p>


</div>
@endsection