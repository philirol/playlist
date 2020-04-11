@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Abonnement du groupe') @if(Auth::check()) {{ Auth::user()->band->bandname }} @endif</h4></td>
  </tr>
</table>
</div>

<div class="py-3 row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">@lang('Formules d\'abonnement')                
            </div>
            <div class="card-body"> 
            @empty($userSubscr) 
                <ul class="list-group">
                    @foreach($plans as $plan)
                        <li class="list-group-item clearfix">
                            <div>
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <h4>{{ $plan->name }} : {{ number_format($plan->cost) }}€/@lang('an')</h4>
                                            <h5>@lang('Stockage') {{ $plan->description }}</h5>
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
                    <h5 class="card-title">Votre groupe a déjà contracté un abonnement :</h5>
                    <p class="card-text">
                    Souscripteur : {{$userSubscr->name}}<br>
                    Abonnement créé le : {{ Carbon\Carbon::parse($userSubscr->created_at)->format('d/m/Y') }}<br>
                    Durée de l'abonnement : 1 an renouvelable tacitement<br>
                    Formule : {{$plan->name}}<br>
                    Stockage : {{$plan->description}}<br><br>
                    Stockage consommé : {{ $band->sizedir }} ({{ bcdiv($band->sizedir, 1048576, 0) }}Mo)
                    </p>
                @endempty
            </div>
        </div>
    </div>
</div>

@endsection