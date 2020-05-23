@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-4">
            <div class="card">
                <div class="card-header">{{ __('Validation de votre courriel') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                        </div>
                    @endif

                    <p>@lang("Nous vous avons envoyé un email de confirmation d'inscription").</p>
                    <p>@lang("Merci de cliquer dans le lien à l'intérieur afin de valider votre adresse mail").</p>
                    
                    @lang("Si vous n'avez pas reçu l'email"), 
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('cliquez ici pour en recevoir un nouveau') }}</button>.
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection