@extends('layouts.app')

@section('content')
@include('includes.songhead')
    <hr>
    <form action="{{ route('songsub.store') }}" enctype="multipart/form-data" method="POST">
    @include('includes.formsongsub')
        <button type="submit" class="btn btn-primary my-4">@lang('Valider')</button>
        <a href="javascript:history.back()" class="btn btn-outline-primary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Annuler')
        </a>
    </form>   
    <script type="text/javascript">
        $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });
    </script>
@endsection