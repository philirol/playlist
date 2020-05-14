@extends('layouts.appvisitors')

@section('content')
@section('style_photos')
@endsection
<!-- 
<style type="text/css">
      .photos { width: 100%; margin-bottom: 20px;}
</style> -->
<x-flag-page position="center" type="{{config('app.visitorflagcolor')}}" :band="$band" page="Book" margbot="0"/>
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