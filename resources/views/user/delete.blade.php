@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Suppression utilisateur')</h4></td>
  </tr>
</table>
</div>
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
    <p class="text-muted">@lang('Créé le') {{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</p>
    
    @if($subscr == 1)
    <p class="text-danger">Ce membre a souscrit un abonnement pour le compte du groupe.</p>
    <p>Supprimer ce membre supprimera son abonnement et les fichiers dépassant la limite de free upload qui est de 500Mo.<br>
        Les fichiers les plus anciens seront supprimés à hauteur de cette limite.
    </p>
    <div class="jumbotron">
        <span class="note">
        This member has an active subscription.<br>
        Deleting him will destroy the oldest uploaded files up to the free limit storage.
        </span>
    </div>

    <p><a href="{{ route('storedfilelist') }}" class="note">@lang('Voir les fichiers du groupe')</a></p>
    <p><a href="{{ route('plans.show') }}" class="note">@lang('Voir l\'abonnement')</a></p>
    @endif
    
    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">@lang('Supprimer')</button>
    </form>
    <a href="javascript:history.back()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')</a>
     {{--<a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-primary">Retour</a>--}}
    
@endsection

