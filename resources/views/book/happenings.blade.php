@extends('layouts.appvisitors')

@section('content')
<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="Happenings" margbot="3"/>
  <!-- <div class="py-5 bg-light"> -->
          @if($happenings->isNotEmpty())
            @foreach($happenings as $media)
                <div class="mt-5 bg-light">
                    @isset($media->name)
                    <img class="rounded mx-auto d-block" src="{{ asset('storage/' . $media->name) }}" alt="image-happening">
                    @else
                    <img class="rounded mx-auto d-block" src="{{ asset('storage/happenings-default.png') }}" alt="image-default-happening">
                    @endif 
                            <p><h3 class="text-center">{{ $media->title }}</h3></p>
                            <div class="jumbotron">{{ $media->description }}</div>         
                    </div>
            @endforeach
          @else 
          <div class="col-md-4">@lang("Le groupe n'a pas encore mis de vidéos.")</div>
          @endif
  <!-- </div> -->
<!-- <span class="note">(les vidéos sont visualisées sur la playlist).</span> -->
@endsection