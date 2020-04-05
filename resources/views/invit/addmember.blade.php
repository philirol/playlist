@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>{{ $band->bandname }}</h4> <h6>@lang('Invitation membre')</h6></td>
  </tr>
</table>
</div>

<div class="py-2 container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>Indiquer ci-dessous l'email du membre à inviter.<br>
            Il recevra un email avec un bouton de validation pour accepter l'invitation.</p>
            <p class="note">Enter the email of a partner to join the band.<br>
            He will receive an email with a validation button to accept your invitation.</p><br>
        
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('invit.mailtomember', ['band' => $band->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">@lang('Email du membre') (*)</label>
                        <div>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" maxlength="60" autofocus>     
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @enderror
                        </div> 
                    </div>

                    <div class="form-group">
                        <label class="label">@lang('Message')</label>
                        <textarea class="form-control @error('comments') is-invalid @enderror" name="message" placeholder="@lang('Saisir un message d\'invitation')">{{ old('message') }}</textarea>                
                        @error('message')
                        <div class="invalid-feedback">
                            {{ $errors->first('message') }}
                        </div>
                        @enderror
                    </div>

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
                <span class="note">(*) @lang('Saisie obligatoire') </span>
        </div>
    </div>
</div>
 
@endsection