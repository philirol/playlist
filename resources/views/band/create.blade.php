@extends('layouts.app')

@section('content')
<h3>@lang('Nouveau groupe')</h3>
<br>
<form action="{{ route('band.store') }}" method="post" enctype="multipart/form-data">
@include('includes.formband')
<button type="submit" class="btn btn-primary my-4">Valider</button>
</form>
@endsection