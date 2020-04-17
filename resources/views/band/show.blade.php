@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>{{ $band->bandname }}</h4> <h6>@lang('Membres')</h6></td>
    @if(Auth::check() and Auth::user()->admin)
    <td class="text-right"><a href="{{ route('band.songs', ['band' => $band->id]) }}" class="btn btn-primary my-3">@lang('Voir Playlist')</a></td>
    @endif
  </tr>
</table>
</div>

<p class="text-muted font-italic">@lang('Création du groupe le') {{ Carbon\Carbon::parse($band->created_at)->format('d m Y') }} {{-- - {{ $band->ville->ville_nom }} ({{ $band->ville->ville_code_postal }}) --}}</p>
    @can('update', $band)
        <ul class="list-inline">
        <small>
        <li class="list-inline-item"><a href="{{ route('band.edit', ['band' => $band->id]) }}">@lang('Modif nom du groupe')</a></li>
        <li class="list-inline-item"><a href="{{ route('invit.addmember') }}">@lang('Ajouter des musiciens')</a></li>
        <li class="list-inline-item"><a href="{{ route('band.delete') }}">@lang('Supprimer le groupe')</a></li>
        
        </small>
        </ul>
    @endcan
    {{-- With cards
    @foreach($band->users as $user)
    <div class="card border-info mb-3" style="max-width: 20rem;">
        <h5 class="card-header">{{ $user->name }}</h5>
        <div class="card-body text-info">
            <p class="card-text"><u>{{ $user->email }}</u></p>
            <p class="card-text">Créé le {{ Carbon\Carbon::parse($user->created_at)->format('d m y') }}</p>
            <br>            
        </div>
    </div>
    @endforeach--}}

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
                    <p class="card-text"><u>{{ $user->email }}</u></p>
                    @can('delete',$user)
                    <small><a href="{{ route('user.delete', $user->id) }}" onclick="return delAsk();">@lang('supprimer')</a></small>
                    @endcan  
                    
                                  
                </div>
            </div>
        </div>
    </div>
    @endforeach

<a href="{{ action('SongController@index', '1') }}" class="btn btn-primary">@lang('Retour Playlist')</a>

@endsection

@section('scripts')
<script type="text/javascript">
    function delAsk() {
      if(!confirm('Supprimer le membre ?'))
      event.preventDefault();
  }
</script>        
@endsection
