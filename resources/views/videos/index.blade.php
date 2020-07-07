@extends('layouts.app')

@section('content')
<x-flag-page position="center" type="{{config('app.appflagcolor')}}" page="{{__('Book - Videos')}}" margbot="0"/>

@include('includes.menubook')

<p class="pt-4 text-center">Télécharger ici vos fichiers audio et vidéos pour votre book.</p>
  <ul class="text-center list-inline">
        <small>
        <li class="list-inline-item"><a href="{{ route('videos.create') }}">@lang('Télécharger une vidéo')</a></li>     
        </small>
        </ul>
  <div class="py-5 bg-light">
    <div class="container ">

      <div class="row row-cols-1 row-cols-md-2">
        @foreach($medias as $media)
          <div class="col mb-4">
            <div class="card shadow-sm">
                  <video class="card-img-top" id='video' poster="@if($media->type > 2) {{asset('images/audiowave2.jpg')}} @endif" controls>
                  <source src = "{{ asset('storage/' . $media->name) }}" type="video/mp4">
                  @lang('Le navigateur ne supporte pas le format de vidéo.')
                </video>

              <div class="card-body">
                <h5 class="card-text">
                  @isset($media->description) {{$media->description}} @else <span class="note">(pas de description)</span> @endisset
                </h5>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{ route('videos.edit', [$media]) }}" class="btn btn-sm btn-outline-secondary">@lang('Edit')</a>
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