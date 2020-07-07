@extends('layouts.app')

@section('content')
@section('style_photos')
@endsection
<!-- 
<style type="text/css">
      .photos { width: 100%; margin-bottom: 20px;}
</style> -->
<x-flag-page position="center" type="{{config('app.appflagcolor')}}" page="{{__('Book - Happenings')}}" margbot="0"/>
<!-- <div class="p-3 bg-{{config('app.appflagcolor')}} rounded-lg text-white text-center">
      <div class="d-inline-block"><h4>{{__('Book')}}</h4></div>
</div> -->
@include('includes.menubook')
<p class="pt-4 text-center">@lang('Gérer ici votre liste d\'évenements, concerts')...</p>
  <ul class="text-center list-inline">
        <small>
        <li class="list-inline-item"><a href="{{ route('happenings.create') }}">@lang('Créer un évenement')</a></li>      
        </small>
        </ul>

      @foreach($medias as $media)
      <hr>
      <!-- <div class="py-5 bg-light"> -->
        <!-- <div class="container"> -->
        @isset($media->name)
          <img class="rounded mx-auto d-block" src="{{ asset('storage/' . $media->name) }}" alt="image-happening">
        @else
          <img class="rounded mx-auto d-block" src="{{ asset('storage/happenings-default.png') }}" alt="image-default-happening">
        @endif 
                <p><h3 class="text-center">{{ $media->title }}</h3></p>
                <div class="jumbotron">{{ $media->description }}</div>                      
                <p>
                  <div class="btn-group">
                    <a href="{{ route('happenings.edit', [$media]) }}" class="btn btn-sm btn-outline-secondary">@lang('Edit')</a>
                  </div>
                  <small class="text-muted">{{ Carbon\Carbon::parse($media->created_at)->format('d/m/Y') }}</small>
                </p>          
        <!-- </div> -->
    <!-- </div> -->
    <br>
      @endforeach

<!-- <span class="note">(les vidéos sont visualisées sur la playlist).</span> -->
@endsection