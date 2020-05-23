@extends('layouts.appvisitors')

@section('content')
<x-flag-page position="left" type="{{config('app.visitorflagcolor')}}" :band="$band" page="{{__('Le groupe')}}" margbot="3"/>

    @foreach($band->users as $user)
    <div class="card mb-3" style="max-width: 550px;">
        <div class="row no-gutters">
            <div class="col-md-4">
            @if ($user->image)
                <img src="{{ asset('storage/avatars/' . $user->image) }}" alt="user-avatar" class="rounded float-left">
            @else
                <img src="{{ asset('storage/avatars/avatar.png') }}" alt="user-avatar" class="rounded float-left">
            @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <span class="font-weight-bold">{{ $user->name }}
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection