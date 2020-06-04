@extends('layouts.app')

@section('content')
<x-flag-page position="center" type="{{config('app.appflagcolor')}}" page="Book - Upload Vidéos" margbot="3"/>
<div class="py-4">
        <form method="POST" action="{{ route('videos.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" id="media" name="media" class="custom-file-input @error('media') is-invalid @enderror" required>
                    <label class="custom-file-label" for="media">@lang('Sélectionner un fichier')</label>
                    @if ($errors->has('media'))
                        <div class="invalid-feedback">
                            {{ $errors->first('media') }}
                        </div>
                    @endif
                </div>
                <br>
            </div>

            <div class="form-group">
                <label for="bandname">Description (optional)</label>
                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="description" value="{{ old('description') }}" maxlength="150">
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @enderror  
            </div>
            
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
    </div>
@endsection
