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
        <table class="table table-striped table-sm">
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td><strong>{{ $user->name }}</strong></td>
                    <!-- <td><strong>{{ $user->email }}</strong></td> -->
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->leader }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

@endsection