@extends('layouts.app')

@section('content')
@section('style_photos')
@endsection
<!-- 
<style type="text/css">
      .photos { width: 100%; margin-bottom: 20px;}
</style> -->
<x-flag-page position="center" type="{{config('app.appflagcolor')}}" page="{{__('Book - Photos')}}" margbot="0"/>
<!-- <div class="p-3 bg-{{config('app.appflagcolor')}} rounded-lg text-white text-center">
      <div class="d-inline-block"><h4>{{__('Book')}}</h4></div>
</div> -->
<a href="{{ route('photos.index') }}" class="btn btn-secondary btn-sm">Photos</a>
<a href="{{ route('videos.index') }}" class="btn btn-success btn-sm">Videos</a>
<a href="{{ route('story.index') }}" class="btn btn-warning btn-sm">Story</a>
<p class="pt-4 text-center"> Vous pouvez ici composer votre book de photos, qui sera accessible à partir du site visiteurs.</p>
  <ul class="text-center list-inline">
        <small>
        <li class="list-inline-item"><a href="{{ route('photos.create') }}">@lang('Télécharger une photo')</a></li>      
        </small>
        </ul>
  <div class="py-5 bg-light">
    <div class="container">

      <div class="row">
        @foreach($medias as $media)
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
            <img src="{{ asset('storage/' . $media->name) }}" class="rounded float-left" id="imgbook">
              <div class="card-body">
                <p class="card-text">
                  @isset($media->description) {{$media->description}} @else <span class="note">(pas de description)</span> @endisset
                </p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{ route('photos.edit', [$media]) }}" class="btn btn-sm btn-outline-secondary">@lang('Edit')</a>
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
<!-- <span class="note">(les vidéos sont visualisées sur la playlist).</span> -->
@endsection