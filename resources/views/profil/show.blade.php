@extends('layouts.app')

@section('content')
    <div class="col-sm-offset-4 col-sm-4">
    	<br>
		<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">@lang('Fiche Utilisateur')</div>
            <div class="card-body">
                <h5 class="card-title">@lang('Nom') : {{ $user->name }}</h5>
                <br>
                <p class="card-text">@lang('Groupe') : {{ $user->band->bandname }}</p>
                <br>
                <p class="card-text">Email : {{ $user->email }}</p>
                <br>
                <p>@lang('Administrateur') : 
                @if($user->admin == 1)
                @lang('Oui')
                    @else
                    @lang('Non')
                @endif
                </p>
            </div>
        </div>			
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')
        </a>
        <a href="{{ route('profil.edit', ['user' => $user->id]) }}" class="btn btn-secondary my-3">Modifier</a>

	</div>
@endsection

