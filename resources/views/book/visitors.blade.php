@extends('layouts.app')

@section('content')
<x-flag-page position="center" type="{{config('app.appflagcolor')}}" page="{{__('Partie visiteurs')}}" margbot="3"/>

<div class="text-center">
    <p>@lang('Transmettre le lien ci-dessous pour présenter votre groupe') :</p> 
    <p><a href="{{ $url }}" target="_blank">{{$url}}</a></p>
    
</div>
<div class="col-md-6 py-4">
    <p>
    {{ __('visitors.sent1') }} :
        <ul>
            <li>{{ __('visitors.sent2') }},</li>
            <li>{{ __('visitors.sent3') }},</li>
            <li>{{ __('visitors.sent4') }},</li>
            <li>{{ __('visitors.sent5') }},</li>
            <li>{{ __('visitors.sent6') }},</li>
            <li>{{ __('visitors.sent7') }},</li>
            <li>{{ __('visitors.sent8') }},</li>
            <li>{{ __('visitors.sent9') }}.</li>
        </ul>
    </p>


</div>
@endsection