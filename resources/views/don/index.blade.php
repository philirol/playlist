@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Faire un don')</h4></td>
  </tr>
</table>
</div>
<div class="py-4 row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">@lang('Versement libre')</div>
            <div class="card-body">  
                @if(Auth::check())   
                                
                <form action="{{ route('don.post') }}" method="post">
                @csrf
                <div>
                    <label for="prix">@lang('Votre montant')</label>
                    <input type="text" name="prix" id="prix">
                   
                    <button>@lang('Procéder au paiement')</button>
                </div> 
                </form>
                @else
                <p>Pour effectuer un don, meci de vous  <a href="{{ route('login') }}">inscrire</a> ou de vous <a href="{{ route('register') }}">connecter</a>.</p>
                <br>
                <p class="note">You must be connected to process a donation.</p>            
                @endif

            </div>
        </div>
    </div>
</div>

@endsection