@extends('layouts.app')

@section('content')
<h3>Modification du groupe</h3>
<br>
<form action="{{ route('band.update', ['band' => $band->id]) }}" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @include('includes.formband')
<button type="submit" class="btn btn-primary my-4">Valider</button>
</form>
 
@endsection