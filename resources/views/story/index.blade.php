@extends('layouts.app')

@section('content')
<!-- 
<style type="text/css">
      .photos { width: 100%; margin-bottom: 20px;}
</style> -->
<x-flag-page position="center" type="{{config('app.appflagcolor')}}" page="{{__('Book - Story')}}" margbot="0"/>
<!-- <div class="p-3 bg-{{config('app.appflagcolor')}} rounded-lg text-white text-center">
      <div class="d-inline-block"><h4>{{__('Book')}}</h4></div>
</div> -->
<a href="{{ route('photos.index') }}" class="btn btn-secondary btn-sm">Photos</a>
<a href="{{ route('videos.index') }}" class="btn btn-success btn-sm">Videos</a>
<a href="{{ route('story.index') }}" class="btn btn-warning btn-sm">Story</a>

@if($story <> null)
  <br /><br />
  <div class="py-5 bg-light">
    <div class="container">
        <p class="text-justify">{{ $story->text }}</p>
    </div>
  </div>
  
  <div class="btn-group py-3">
    <a href="{{ route('story.edit', [$story]) }}" class="btn btn-sm btn-outline-secondary">@lang('Edit')</a>
  </div>
  @else 
  <br /><br />
    <ul class="text-center list-inline">
      <small>
      <li class="list-inline-item"><a href="{{ route('story.create') }}">@lang('Écrire votre story')</a></li>        
      </small>
    </ul>
  @endif


@endsection
