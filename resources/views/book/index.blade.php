@extends('layouts.appvisitors')

@section('content')
<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="{{__('Accueil')}}" margbot="3"/>
@section('players')
@endsection
<p>{{ __('bookHome.sent1') }} {{$band->bandname}}.</p>
<p>{{ __('bookHome.sent2') }}.</p>
<p>
{{ __('bookHome.sent3') }} <img src="{{asset('images/ytb.png')}}" alt="Icon player" title="click to load in player"> {{ __('bookHome.sent4') }} <img src="{{asset('images/file2.png')}}" alt="Icon player" title="click to load video in player"> {{ __('bookHome.sent5') }}.
</p>
<p>{{ __('bookHome.sent6') }} ;-)</p>

@endsection