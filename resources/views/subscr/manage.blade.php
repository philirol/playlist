@extends('layouts.app')

@section('content')

<x-flag-page position="left" type="{{config('app.appflagcolor')}}" page="{{__('Gestion de votre abonnement)}}" margbot="3"/>

<div class="py-2 row justify-content-center">
    <div class="col-md-8">
    @foreach($userCustomer->subscriptions as $subscr)
      {{-- $subscr->id --}}
      <p>
        @lang('Abonnement créé le') : {{ \Carbon\Carbon::parse($subscr->created)->format('d/m/Y')}}<br>
        @lang('Date de renouvellement') : {{ \Carbon\Carbon::parse($subscr->current_period_end)->format('d/m/Y')}}
      </p>
      <h3>@lang('Suppression de l\'abonnement')</h3>
      <p>En supprimant votre abonnement, le volume de stockage disponible pour les fichiers de votre groupe reviendront à la limite des 500Mo (formule free).
        
        Votre abonnement sera définitivement supprimé et ne sera pas renouvelé, vous ne serez donc pas débité pour la prochaine période.        
        Voir les <a href="{{ URL::to('/CGV') }}">CGV</a> pour plus de détails.<br>
        <b>Les fichiers présents sur la playlist seront supprimés à hauteur de la formule free (par ordre d'ancienneté).</b><br>
      </p>
      <div class="jumbotron">
      <span class="note">
        By deleting your subscription, the available storage for your band files will return to the free limit (500Mo).
        <br>
        Your subscription will be definitely deleted and you won't be charged for the next period.<br>
        <b>Your exceeding files up to free plan will be erased (oldest files will be erased).</b>
      </span>
      </div>
        <a href="{{ route('storedfilelist') }}" class="note">@lang('Liste des fichiers')</a>
        <br><br>
      <p>
        <a href="{{ route('subscr.delete') }}" type="button" class="btn btn-danger">@lang('Supprimer')</a>
        <a href="javascript:history.back()" class="btn btn-outline-dark"><span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')</a>
    </p>
    @endforeach
    {{-- $userCustomer --}}
    </div>
</div>

@endsection
