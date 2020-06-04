@extends('layouts.appvisitors')
@section('content')
<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="Story" margbot="4"/>
</div>
<div class="container">
  <div class="jumbotron">
    @if($story->isNotEmpty())
        @foreach($story as $story)
            {{ $story->text }}
        @endforeach
    @else 
    <p>@lang("Le groupe n'a pas encore rédigé sa story.")</p>
    @endif
      </div>
</div>
@endsection