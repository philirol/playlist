@extends('layouts.app')

@section('content')
@section('style_photos')
@endsection
<!-- 
<style type="text/css">
      .photos { width: 100%; margin-bottom: 20px;}
</style> -->
<x-flag-page position="left" type="{{config('app.appflagcolor')}}" page="Album Photos/Vidéos" margbot="3"/>

    <div class="py-5 bg-light">
        <div class="col-md-8 mx-auto">
            <div class="row">
                <img src="{{ asset('storage/' . $media->name) }}" class=" mx-auto img-fluid img-thumbnail"  style="width:300px">
            </div>        

            <form action="{{ route('medias.update', [$media]) }}" method="post" enctype="multipart/form-data" style="display: inline;">
                @method('PATCH')
                @csrf

                <div class="form-group">
                    <label class="label"></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="@lang('Description')" maxlength="255">{{ old('description') ?? $media->description }}</textarea>                
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary my-4">@lang('Valider')</button>
            </form>

            <form action="{{ route('medias.destroy', [$media]) }}" method="POST" enctype="multipart/form-data" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">@lang('Supprimer')</button>
            </form>
            <a href="javascript:history.back()" class="btn btn-outline-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Annuler')
            </a>

        </div>
    </div>
@endsection