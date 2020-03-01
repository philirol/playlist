@extends('layouts.app')

@section('content')

<h1>Profil utilisateur</h1>

@if (Auth::guard('web')->check())


<form action="{{ route('profil.update', $user->id) }}" method="POST">
@csrf
@method('put')
<div class="jumbotron">
  <div class="form-group">
    <label for="name">@lang('Nom complet ou pseudo')</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}"  placeholder="Nom">
    @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group">
    <label for="email">@lang('Adresse email')</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" placeholder="Email">
    @error('email')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group">
    <label for="email">@lang('Mot de passe')</label>
    <input type="password" name="password" class="form-control @error('passowrd') is-invalid @enderror"  placeholder="Password" />
    @error('password')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div> 

  <div class="form-group">
    <label for="email">@lang('Confirmation du mot de passe')</label>
    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" />
    @error('password_confirmation')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div> 

  <div class="form-group">
    <label for="band">@lang('Nom du groupe')</label>
    <input id="bandname" type="text" class="form-control @error('bandname') is-invalid @enderror" value="{{ old('bandname', $user->band->bandname) }}"  placeholder="Nom du groupe">
    @error('bandname')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  
  <button type="submit">@lang('Soumettre')</button>
</div>
</form>


@endif


@endsection