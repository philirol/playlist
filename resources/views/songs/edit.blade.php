@extends('layouts.app')

@section('content')
<h3>@lang('Page de modification')</h3>
<br>
<form action="{{ route('songs.update', ['song' => $song->id]) }}" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @include('includes.formsong')
<button type="submit" class="btn btn-primary my-4">@lang('Valider')</button>
</form>
 
@endsection