@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-4">
            <div class="card">
                <div class="card-header">{{ __('verify.sent1') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                        {{ __('verify.sent2') }}
                        </div>
                    @endif
                    <p>{{ __('verify.sent3') }}</p>
                    <p>{{ __('verify.sent4') }}</p>
                    
                    {{ __('verify.sent5') }}, 
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('verify.sent6') }}</button>.
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection