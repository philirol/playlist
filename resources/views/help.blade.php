@extends('layouts.app')

@section('content')
<x-flag-page position="left" type="{{config('app.appflagcolor')}}" page="{{__('Aide')}}" margbot="3"/>
<h5>Page en construction</h5>
<hr>
<ul>
<li>Le leader invite ses coéquipiers musiciens dans la section "Le groupe".</li>

<li>Pour réordonner les numéros de la Playlist si ceux-ci sont mal affichés sur l'impression, changer l'ordre sur un morceau et rechanger le pour revenir à la même position.</li>
<li>Pour imprimer sur 2 colonnes, astuce : quand vous êtes dans le document pdf, vous sélectionner tout (menu Edition ou Ctrl+A) et coller dans Word ou un autre logiciel de traitement de texte. Une fois votre texte dedans, vous faites "Mise en page", "Colonne", et vous choisissez 2 colonnes.</li>
@endsection
</ul>