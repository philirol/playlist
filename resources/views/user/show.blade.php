@extends('layouts.app')

@section('content')

<x-flag-page position="left" type="{{config('app.appflagcolor')}}" page="{{__('Vos données personnelles')}}" margbot="3"/>

    <div class="mt-4 card mb-3">
        <div class="row no-gutters">
            <div class="col-md-2">
            @if ($user->image)
                <img src="{{ asset('storage/avatars/' . $user->image) }}" alt="user-avatar" class="rounded float-left">
            @else
                <img src="{{ asset('storage/avatars/avatar.png') }}" alt="user-avatar" class="rounded float-left">
            @endif
            </div>
            <div class="col-md-10">
                <div class="card-body">
                    <p class="card-title"><strong>{{ $user->name }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;<small><u>{{ $user->email }}</u></small></p>   
                                     
                    @if($user->story) 
                        <p class="card-text">{{$user->story}}</p> 
                        @else
                        <p><a href="#" class="btn btn-warning btn-sm disabled" tabindex="-1" role="button" aria-disabled="true">@lang('Pas de story')</a></p>
                    @endif
                </div>
            </div>
        </div>
        <!-- <a href="#" class="btn btn-warning btn-lg disabled" tabindex="-1" role="button" aria-disabled="true">@lang('Pas de story')</a> -->
    </div>


    <p class="text-muted">@lang('Créé le') {{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</p>    
    <p><a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-secondary my-3">@lang('Modifier')</a></p>
    <p>@lang('Pour changer de mot de passe, ') 
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('déconnecter-vous')</a>
        @lang('et cliquez sur "Mot de passe oublié".')
    </p>	
    {{--<a href="javascript:history.back()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')</a>--}} 
     {{--<a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-primary">Retour</a>--}}
    
@endsection

