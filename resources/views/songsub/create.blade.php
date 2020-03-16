@extends('layouts.app')

@section('content')
@include('includes.songhead')
    <hr>
    <form action="{{ route('songsub.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
        @if($sub=='lk')
        <div class="form-group">
            <label for="title">@lang('Titre (champ obligatoire)')</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="@lang('Saisir un titre')" value="" autofocus> 
            @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="label">@lang('Ajouter un lien')</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="@lang('Saisir un lien')" value=""> 
            @error('url')
            <div class="invalid-feedback">
                {{ $errors->first('url') }}
            </div>
            @enderror
        </div>
        @elseif($sub=='fl')
        <div class="form-group">
            <label class="label">@lang('Ajouter un fichier')</label>
            <div class="custom-file">
                <input type="file" name="songfile" class="custom-file-input @error('songfile') is-invalid @enderror">
                <label class="custom-file-label">@lang('Sélectionner un fichier')</label>
                @error('songfile')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @endif
        <button type="submit" class="btn btn-primary my-4">@lang('Valider')</button>
    </form>   
    <script type="text/javascript">
        $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });
    </script>
@endsection