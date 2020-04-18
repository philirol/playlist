@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h3>@lang('Liste des utilisateurs') ({{ $users_nbr }})</h3></td>
    <td class="text-right">
        <div class="select">
            <select onchange="window.location.href = this.value">
                <option value="{{ route('user.indexByAdmin', ['slug' => 'noband','sort' => 'id']) }}" @unless($slug) selected @endunless>@lang('Tous les groupes')</option>
                @foreach($bands as $band)
                    <option value="{{ route('user.band', $band->slug) }}" {{ $slug == $band->slug ? 'selected' : '' }}>{{ $band->bandname }}</option>
                @endforeach
            </select>
        </div>
    </td>
  </tr>
</table>
</div>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col"><a href="{{ route('user.indexByAdmin', ['slug' => session('slug'),'sort' => 'id']) }}">id</a></th>
            <th scope="col"><a href="{{ route('user.indexByAdmin', ['slug' => session('slug'),'sort' => 'name']) }}">Pseudo</a></th>                    
            <th scope="col"><a href="{{ route('user.indexByAdmin', ['slug' => session('slug'),'sort' => 'nconnex']) }}">ncon</a></th>
            <th scope="col"><a href="{{ route('user.indexByAdmin', ['slug' => session('slug'),'sort' => 'email']) }}">email</a></th> 
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</td>
            <td>
            {{ $user->name }}
            @if($user->leader)
                <strong>(leader)</strong>
            @endif
            </td>
            <td>{{ $user->nconnex }}</td>
            <td>{{ $user->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

