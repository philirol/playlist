@extends('layouts.app')

@section('content')
    <h1>{{ $song->title }}</h1>
    <a href="{{ route('songs.edit', ['song' => $song->id]) }}" class="btn btn-secondary my-3">Editer</a>
    <form action="{{ route('songs.destroy', ['song' => $song->id]) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
    <hr>
    <p><strong>Titre :</strong> {{ $song->title }} (posté par {{ $user }})</p>
    <p><strong>Liste :</strong> {{ $song->list }}</p>
    <p><strong>Lien :</strong> {{ $song->reference }}</p>
    @if ($song->note)
    <p><strong>Note :</strong> {{ $song->note }}</p>
    @else
    (Pas de note)
    @endif
    <p><strong>Groupe :</strong> {{ $band }}</p>

    
    <br><br>
    <p><strong>get list :</strong> {{ var_dump( $song->getListOptions() ) }}</p>
    <p><strong>get list :</strong> {{-- $song->getListAttribute[$key][$value] --}}</p>
    
    


@endsection