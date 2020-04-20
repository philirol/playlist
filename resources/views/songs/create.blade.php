@extends('layouts.app')

@section('content')
<h3>@lang('Nouveau morceau')</h3>
<br>
<form action="{{ route('songs.store') }}" method="post">
@include('includes.formsong')
<button type="submit" class="btn btn-primary my-4">@lang('Valider')</button>
<a href="javascript:history.back()" class="btn btn-outline-primary">
<span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Annuler')
</a>
</form>
@endsection