@extends('layouts.app')

@section('content')
@section('style_photos')
@endsection
<!-- 
<style type="text/css">
      .photos { width: 100%; margin-bottom: 20px;}
</style> -->
<x-flag-page position="center" type="{{config('app.appflagcolor')}}" page="{{__('Book - Happenings')}}" margbot="3"/>

    <div class="py-5 bg-light">
        <div class="col-md-8 mx-auto">
            <div class="row mb-4">
                <img src="{{ asset('storage/' . $media->name) }}" class="mx-auto rounded">
            </div>        
            <p class="text-center small">  
                @if ($media->name != 'happenings-default.png')
                <a href="{{ route('happenings.deleteposter', ['media' => $media->id]) }}">@lang('Supprimer la photo')</a>
                @endif
            </p>  
            <form action="{{ route('happenings.update', [$media]) }}" method="post" enctype="multipart/form-data" style="display: inline;">
                @method('PATCH')
                @csrf                				
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" name="media" class="custom-file-input @error('media') is-invalid @enderror" id="validatedCustomFile">
                        <label class="custom-file-label" for="validatedCustomFile">@lang('Sélectionner une affiche')</label>
                        @error('media')
                            <div class="invalid-feedback">
                                {{ $errors->first('media') }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="label">@lang('titre')</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="@lang('Saisir un titre')" value="{{ old('title') ?? $media->title }}">             
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="@lang('Description')" maxlength="150">{{ old('description') ?? $media->description }}</textarea>                
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary my-4">@lang('Valider')</button>
            </form>

            <form action="{{ route('happenings.destroy', [$media]) }}" method="POST" enctype="multipart/form-data" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">@lang('Supprimer')</button>
            </form>
            <a href="javascript:history.back()" class="btn btn-outline-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Annuler')
            </a>

        </div>
    </div>
    <script type="text/javascript">
        $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });
    </script>
@endsection