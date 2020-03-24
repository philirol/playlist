@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('Modification groupe')</div>

                <div class="card-body">
                    <form action="{{ route('band.update', ['band' => $band->id]) }}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @include('includes.formband')
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                @lang('Valider')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
 
@endsection