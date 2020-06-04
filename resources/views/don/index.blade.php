@extends('layouts.app')

@section('content')
<x-flag-page position="left" type="{{config('app.appflagcolor')}}" page="{{ __('Faire un don') }}" margbot="3"/>
<div class="py-4 row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">@lang('Versement libre')</div>
            <div class="card-body">  
                @if(Auth::check())   
                                
                <form action="{{ route('don.post') }}" method="post">
                @csrf
                <label for="amount">@lang('Indiquer un montant et vous serez redirigé vers le formulaire de paiement'):</label>
                <div class="form-group">
                    <input type="text" id="amount" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="@lang('Votre montant')" value="{{ old('amount') }}" style="width:150px;"> €
                    @error('amount')
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                    @enderror
                </div>
                    <button type="submit" class="btn btn-dark">@lang('Valider')</button>
                </form>
                @else
                <p>Pour effectuer un don, meci de vous  <a href="{{ route('login') }}">inscrire</a> ou de vous <a href="{{ route('register') }}">connecter</a>.</p>
                <br>
                <p class="note">You must be connected to process a amount.</p>            
                @endif

            </div>
        </div><br>
        <p><a href="{{ route('donhist') }}">@lang('Vos dons')</a></p>
    </div>
</div>

@endsection