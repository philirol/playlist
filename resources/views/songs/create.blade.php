@extends('layouts.app')

@section('content')
<h3>@lang('Nouveau morceau')</h3>
<br>
<form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data">
@include('includes.formsong')
<button type="submit" class="btn btn-primary my-4">Valider</button>
</form>
@endsection