@extends('layouts.app')

@section('content')
<h3>@lang('Nouveau morceau')</h3>
<br>
<form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data">
@include('includes.formsong')
<button type="submit" class="btn btn-primary my-4">Valider</button>
</form>
    <script type="text/javascript">
        $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });
    </script>
@endsection