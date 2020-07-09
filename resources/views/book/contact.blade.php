@extends('layouts.appvisitors')

@section('content')

<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="Contact" margbot="3"/>
<p>@lang('Contactez le leader du groupe') {{$band->bandname}}.</p>
    @if (!session()->has('message'))
        <form action="{{ route('contact.store', [$band]) }}" method="POST">
            @include('includes.formcontact')
    @endif
@endsection