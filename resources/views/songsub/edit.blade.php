@extends('layouts.app')

@section('content')
@include('includes.songhead')
    <hr>
    <form action="{{ route('songsub.update', ['songsub' => $songsub->id]) }}" enctype="multipart/form-data" method="post">
    @method('PATCH')
    @include('includes.formsongsub')
        <button type="submit" class="btn btn-primary my-4">@lang('Valider')</button>
        <a href="{{ action('SongController@show', session('song')) }}" class="btn btn-outline-primary">@lang('Annuler')</a>
    </form>   
    
    <script type="text/javascript">
        $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });
    </script>
@endsection