@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-4 row justify-content-center">
        <p>Vous disposez du plan <strong>{{$plan->name}}</strong> vous permettant d'avoir un espace de stockage de <u>{{$plan->datavol}}</u> pour tous vos fichiers.<br><br>
        Vous pouvez voir plus de détails sur votre abonnement en cliquant <a href="{{ route('plans.show') }}">ici</a></p>                

    </div>
</div>
 
@endsection