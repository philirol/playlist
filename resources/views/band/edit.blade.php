@extends('layouts.app')

@section('content')
<x-flag-page position="left" type="{{config('app.appflagcolor')}}" :band="$band" page="{{__('Modification du nom')}}" margbot="0"/>

<div class="py-4 container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('band.update', ['band' => $band->id]) }}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @include('includes.formband')
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                @lang('Valider')
                                </button>
                                <a href="{{ route('band.show')}}" class="btn btn-outline-primary">@lang('Annuler')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection