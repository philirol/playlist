@extends('layouts.app')

@section('content')

<h3>@lang('Liste des utilisateurs') ({{ $users_nbr }})</h3>
<br><table class="table">
            <tr class="table-info">
                <td class="align-middle">
                    <div class="select">
                        <select onchange="window.location.href = this.value">
                            <option value="{{ route('user.indexByAdmin') }}" @unless($slug) selected @endunless>@lang('Tous les groupes')</option>
                            @foreach($bands as $band)
                                <option value="{{ route('user.band', $band->slug) }}" {{ $slug == $band->slug ? 'selected' : '' }}>{{ $band->bandname }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td class="text-right"><a href="{{ route('user.create') }}" class="btn btn-primary my-3">@lang('Créer un membre')</a></td>
            </tr>
        </table>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Pseudo</th>                    
                    <th scope="col">ncon</th>
                    <th scope="col">@lang('Email')</th> 
                </tr>
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