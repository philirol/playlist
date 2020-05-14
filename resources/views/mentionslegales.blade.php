@extends( session('visitors') == 1 ? 'layouts.appvisitors' : 'layouts.app' )

@section('content')
<x-flag-page position="left" type="{{ session('visitors') == 1 ? config('app.visitorflagcolor') : config('app.appflagcolor') }}" page="Mentions Légales" margbot="3"/>

<h3>Editeur</h3>
<p>Le site Playlist est édité par la société Védas Informatique, micro-entreprise inscrite au répertoire des métiers sous le numéro d'immatriculation 849 500 012 RM 34</p>
{{-- 
<h3>Publication</h3>
<p>Le site est publié sous la responsabilité de Philippe Roland</p>
--}}
<h3>Hébergement</h3>
<p>Le site Playlist est hébergé par la société LWS</p>

<h3>Contact</h3>
<p>vedasinformatique@gmail.com</p>

@endsection