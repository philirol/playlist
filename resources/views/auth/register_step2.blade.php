@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('Inscription - Étape 2')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.step2') }}">
                        @csrf                        
                        
                        <div class="form-group row">
                        <label for="departement" class="col-md-4 col-form-label text-md-right">@lang('Ville')</label>
                            <div class="col-md-6">
                                <select name="id" class="form-control @error('id') is-invalid @enderror">
                                        <option value="">--{{ __('Choisir une ville') }}--</option>
                                        @foreach($villes as $ville)
                                            <option value="{{ $ville->id }}">{{ $ville->ville_nom }} - {{ $ville->ville_code_postal }}</option>
                                        @endforeach                                      
                                </select>
                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                @lang('Envoyer')
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
