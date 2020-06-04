@extends('layouts.app')

@section('content')
<x-flag-page position="left" type="{{config('app.appflagcolor')}}" page="{{ __('Modification morceau') }}" margbot="3"/>

<form action="{{ route('songs.update', ['song' => $song->id]) }}" method="post">
    @method('PATCH')
    @include('includes.formsong')
<button type="submit" class="btn btn-primary my-4">@lang('Valider')</button>
<a href="javascript:history.back()" class="btn btn-outline-primary">
<span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Annuler')
</a>
</form>
 
@endsection