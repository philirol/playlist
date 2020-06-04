@extends('layouts.appvisitors')

@section('content')

<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="Contact" margbot="3"/>
<p>Contactez le leader du groupe {{$band->bandname}}.</p>
    @if (!session()->has('message'))
        <form action="{{ route('book.contact', [$band]) }}" method="POST">
            @csrf
            @include('includes.formcontact')
    @endif
@endsection