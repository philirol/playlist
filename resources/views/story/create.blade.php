@extends('layouts.app')

@section('content')
<x-flag-page position="left" type="{{config('app.appflagcolor')}}" page="Book - Story" margbot="3"/>

    <div class="py-5 bg-light">
        <div class="col-md-8 mx-auto">
        Écrire votre story
            <form action="{{ route('story.store') }}" method="post" style="display: inline;">
                @csrf

                <div class="form-group">
                    <label class="label"></label>
                    <textarea class="form-control @error('text') is-invalid @enderror" name="text" maxlength="10000" rows="12" value="{{ old('text')}}" autofocus>
                    </textarea>                
                    @error('text')
                    <div class="invalid-feedback">
                        {{ $errors->first('text') }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary my-4">@lang('Valider')</button>
            </form>
            <a href="javascript:history.back()" class="btn btn-outline-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Annuler')
            </a>

        </div>
    </div>
@endsection