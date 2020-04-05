@extends('layouts.app')

@section('content')
<div class="py-4 container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <p>Bonjour et bienvenu à toi,</p>
        <p>
        Ceci est le formulaire de création d'un groupe et de son "leader" sur Playlist.<br>
        Une fois le groupe créé, le leader pourra inviter les autres membres.<br>
        <u>Si le groupe est déja créé</u>, vous devez attendre le mail d'invitation du leader.
        </p><br>
        <form method="POST" action="{{ route('register') }}">            
        @csrf
            <div class="card">
                <div class="card-header">
                    @isset($item) @lang('Inscription au groupe '){{ $item->user->band->bandname }} @else @lang('Création du groupe') @endisset
                </div>
                <div class="card-body">
                    @empty($item)
                    <div class="form-group row">
                        <label for="bandname" class="col-md-4 col-form-label text-md-right">@lang('Nom du groupe')</label>
                        <div class="col-md-6">                         
                            <input id="bandname" type="text" class="form-control @error('bandname') is-invalid @enderror" name="bandname" value="{{ old('bandname') }}" required autocomplete="bandname" autofocus>
                            @error('bandname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bandname') }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="inv" value="{{ $item->uid }}">
                    @endempty

                    {{--                     
                    <div class="form-group row">
                    <label for="departement" class="col-md-4 col-form-label text-md-right">@lang('Votre département')</label>
                        <div class="col-md-6">
                            <select class="custom-select form-control @error('departement_id') is-invalid @enderror" name="departement_code">
                            <option value="" selected='selected'>-- Sélectionner un département --</option>
                                @foreach($departement as $dep)
                                <option value="{{ $dep->departement_code }}">{{  $dep->departement_code }} - {{  $dep->departement_nom }}</option>
                                @endforeach                                    
                            </select>
                        </div>
                    </div>                         
                    --}}

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">
                            {{ __('Nom/pseudo du leader') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">@lang('Adresse email')</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@isset($item) {{$item->email}} @else {{old('name')}} @endisset" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">@lang('Mot de passe')</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('Confirmation du mot de passe')</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                            @lang('Valider')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
