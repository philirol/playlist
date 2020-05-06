@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Contactez-nous')</h4></td>
  </tr>
</table>
</div>
    @if (!session()->has('message'))
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="@lang('Votre nom')" value="{{ old('name') }}" autofocus>
                @error('name')
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Votre Email')" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <textarea name="message" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror" placeholder="@lang('Votre message...')">
                {{ old('message') }}
                </textarea>
                @error('message')
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">@lang('Envoyer')</button>
        </form>
    @endif
@endsection