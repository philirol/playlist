@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Abonnement')</h4></td>
  </tr>
</table>
</div>

<div class="py-3 row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">@lang('Formules d\'abonnement')                
            </div>
            <div class="card-body"> 
            @empty($banduserSubscr) 
                <ul class="list-group">
                    @foreach($plans as $plan)
                        <li class="list-group-item clearfix">
                            <div>
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <h4>{{ $plan->name }} : {{ number_format($plan->cost) }}€/@lang('an')</h4>
                                            <h5>@lang('Stockage') {{ $plan->datavol }}</h5>
                                        </td>
                                        <td class="text-right">                                                   
                                                @if(!auth()->user()->subscribedToPlan($plan->stripe_plan, 'main'))
                                                    <a href="{{ route('plans.process', $plan->slug) }}" class="btn btn-outline-dark pull-right">Choose</a>
                                                @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </li>
                    @endforeach
                </ul>                
                @else
                    <h5 class="card-title">@lang('Votre groupe a déjà contracté un abonnement') :</h5>
                    <p class="card-text">
                    @lang('Souscripteur') : <strong>{{$banduserSubscr->name}}</strong><br>
                    @lang('Groupe') : {{$band->bandname}}<br>
                    @lang('Abonnement créé le') : {{ Carbon\Carbon::parse($banduserSubscr->created_at)->format('d/m/Y') }}<br>
                    @lang('Durée : 1 an renouvelable tacitement')<br><br>
                    @lang('Formule') : <strong>{{$plan->name}}</strong><br>
                    @lang('Volume de stockage disponible pour cette formule') : {{$plan->datavol}}<br>
                    @lang('Volume des données stockées') : {{ $band->sizedir }} ({{ bcdiv($band->sizedir, 1048576, 0) }}Mo)
                    </p>
                    <p>
                    @if (Auth::user()->name == $banduserSubscr->name)
                        <a href="{{ route('subscr.manage') }}">@lang('Supprimer votre abonnement')</a>
                    @endif
                    </p>
                @endempty
            </div>
        </div>
        @empty($banduserSubscr) @lang('Gratuit jusquà 500Mo') @endempty
    </div>
</div>

@endsection