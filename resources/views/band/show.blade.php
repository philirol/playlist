@extends('layouts.app')

@section('content')
    <div class="col-sm-offset-4 col-sm-4">
    	<br>
		<div class="card border-dark mb-3" style="max-width: 20rem;">
            <div class="card-header">{{ $band->bandname }}</div>
            <div class="card-body text-dark">
                <h5 class="card-title">
                <a href=" {{ route('band.songs', ['band' => $band->id]) }}">@lang('Playlist')</a></h5>
                <p class="card-text">Cliquer sur Playlist pour voir la playlist de ce groupe.</p>
                <br>
                
            </div>
        </div>			
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')
		</a>
	</div>
@endsection

