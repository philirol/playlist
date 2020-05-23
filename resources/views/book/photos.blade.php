@extends('layouts.appvisitors')

@section('content')
@section('style_photos')
@endsection
<!-- 
<style type="text/css">
      .photos { width: 100%; margin-bottom: 20px;}
</style> -->
<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="Photos" margbot="3"/>
  <div class="py-5 bg-light">
    <div class="container">
      <div class="row">
          @if($photos->isNotEmpty())
            @foreach($photos as $media)
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
          @else 
          <div class="col-md-4">@lang("Le groupe n'a pas encore mis de photos.")</div>
          @endif
      </div>
    </div>
  </div>
<!-- <span class="note">(les vidéos sont visualisées sur la playlist).</span> -->
@endsection