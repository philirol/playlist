@extends('layouts.app')

@section('content')
<h3>@lang('Vos données personnelles')</h3>
<br>
    <div class="card mb-3" style="max-width: 550px;">
        <div class="row no-gutters">
            <div class="col-md-4">
            @if ($user->image)
                <img src="{{ asset('storage/avatars/' . $user->image) }}" alt="user-avatar" class="rounded float-left">
            @else
                <img src="{{ asset('storage/avatars/avatar.png') }}" alt="user-avatar" class="rounded float-left">
            @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>   
                                     
                </div>
            </div>
        </div>
    </div>
    <p class="text-muted">@lang('Créé le') {{ $user->created_at->format('d/m/Y') }}</p>
    <p>@lang('Pour changer de mot de passe, ') 
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('déconnecter-vous')</a>
        @lang('et cliquez sur "Mot de passe oublié".')
    </p>	
    {{--<a href="javascript:history.back()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')</a>--}} 
     {{--<a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-primary">Retour</a>--}}
    <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-secondary my-3">Modifier</a>
    
@endsection

