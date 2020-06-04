@extends('layouts.appvisitors')

@section('content')
<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="Vidéos" margbot="3"/>
  <div class="py-5 bg-light">
    <div class="container ">

      <div class="row row-cols-1 row-cols-md-2">
          @if($videos->isNotEmpty())
              @foreach($videos as $media)
                <div class="col mb-4">
                  <div class="card shadow-sm">
                        <video class="card-img-top" id='video' poster="@if($media->type > 2) {{asset('images/audiowave2.jpg')}} @endif" controls>
                        <source src = "{{ asset('storage/' . $media->name) }}" type="video/mp4">
                        @lang('Le navigateur ne supporte pas le format de vidéo.')
                      </video>

                    <div class="card-body">
                      <h5 class="card-text">@isset($media->description) {{$media->description}} @else <span class="note">(pas de description)</span> @endisset</h5>
                    </div>
                  </div>
                </div>
              @endforeach
          @else 
          <div class="col-md-4">@lang("Le groupe n'a pas encore mis de vidéos.")</div>
          @endif
      </div>
    </div>
  </div>
<!-- <span class="note">(les vidéos sont visualisées sur la playlist).</span> -->
@endsection