@extends('layouts.app')

@section('content')
@section('style_photos')
@endsection
<!-- 
<style type="text/css">
      .photos { width: 100%; margin-bottom: 20px;}
</style> -->
<section class="jumbotron text-center bg-info rounded-lg text-white">
    <div class="container">
      <h2>Album Photos/Vidéos</h2>
      <p class="text-white"> Vous pouvez ici composer votre book de photos, qui sera accessible à partir du site visiteurs.</p>
    </div>
  </section>

  <p class="note text-center"><a href="{{ route('medias.create') }}">Télécharger une nouvelle photo</a></p>

  <div class="py-5 bg-light">
    <div class="container">

      <div class="row">
        @foreach($medias as $media)
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
            <img src="{{ asset('storage/' . $media->name) }}" class="rounded float-left">
              <div class="card-body">
                <p class="card-text">
                  @isset($media->description) {{$media->description}} @else <span class="note">(pas de description)</span> @endisset
                </p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{ route('medias.edit', [$media]) }}" class="btn btn-sm btn-outline-secondary">@lang('Edit')</a>      

                  </div>
                  <small class="text-muted">{{ Carbon\Carbon::parse($media->created_at)->format('d/m/Y') }}</small>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
<span class="note">(les vidéos sont visualisées sur la playlist).</span>
@endsection