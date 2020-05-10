@extends('layouts.appvisitors')

@section('content')
<div class="bg-secondary rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Membres') of {{ $band->bandname }}</h4> </td>
  </tr>
</table>
</div>
<p class="text-muted font-italic">@lang('Création du groupe le') {{ Carbon\Carbon::parse($band->created_at)->formatLocalized('%d %B %Y') }}</p>

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
                    <span class="font-weight-bold">{{ $user->name }}</span>&nbsp;&nbsp;
                    <small class="text-muted">(@lang('Créé le') {{ Carbon\Carbon::parse($user->created_at)->format('d m y') }})</small>
                    @can('delete',$user)
                    <small><a href="{{ route('user.delete', $user->id) }}">@lang('supprimer')</a></small>
                    @endcan  
                    
                                  
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection