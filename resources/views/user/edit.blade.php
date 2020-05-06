@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Vos données personnelles')</h4></td>
  </tr>
</table>
</div>
@if (Auth::guard('web')->check())
	<br>
	<form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
	@method('PATCH')
	@csrf
		<div class="card mb-3" style="max-width: 550px;">
			<div class="row no-gutters">
				<div class="col-md-4">
				@if ($user->image)
					<img src="{{ asset('storage/avatars/' . $user->image) }}" alt="user-avatar" class="rounded float-left">
				@else
					<img src="{{ asset('storage/avatars/avatar.png') }}" alt="user-avatar" class="rounded float-left">
				@endif
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<div class="form-group">
							<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="name or pseudo" value="{{ old('name') ?? $user->name }}">
							@error('name')
							<div class="invalid-feedback">{{ $errors->first('name') }}
							@enderror
						</div>
						<div class="form-group">
							<input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') ?? $user->email }}">
							@error('email')
							<div class="invalid-feedback">
								{{ $errors->first('email') }}
							</div>
							@enderror
						</div>
					</div>
				</div>
			</div>
		</div>
		@if ($user->image)
		<p><a href="{{ route('user.deleteImage', ['user' => $user->id]) }}">@lang('Supprimer la photo')</a></p>
		@endif				
		<div class="form-group">
			<div class="custom-file">
				<input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="validatedCustomFile">
				<label class="custom-file-label" for="validatedCustomFile">@lang('Sélectionner une photo')</label>
				@error('image')
					<div class="invalid-feedback">
						{{ $errors->first('image') }}
					</div>
				@enderror
			</div>
		</div>
	    
      <a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')
		</a>
		<button type="submit" class="btn btn-secondary my-3">@lang('Valider')</button>
	</form>
    </div>
	</div>

@endif
	<script type="text/javascript">
        $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });
    </script>
@endsection
