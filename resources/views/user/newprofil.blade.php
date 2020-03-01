@extends('layouts.app')

@section('content')

<h1>Profil utilisateur</h1>


@if (Auth::guard('web')->check())
<h4>Vous devez vous rattacher à un groupe. Commencez par sélectionner la localisation du groupe.</h>

<h5>@lang('Liste des départements')</h5>
<br><table class="table">
            <tr class="table-info">
                <td class="align-middle">
                    <div class="select">
                        <select onchange="window.location.href = this.value">
                            @foreach($departements as $departement)
                                <option value="{{ route('user.ville', $departement->slug) }}" {{ $slug == $departement->slug ? 'selected' : '' }}>{{ $departement->departement_code }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
            </tr>
        </table>
        <table class="table table-striped table-sm">
            <tbody>
            @foreach($villes as $ville)
                <tr>
                    <td><strong>{{ $ville->ville_departement }}</strong></td>
                    <td><strong>{{ $ville->ville_nom }}</strong></td>
                </tr>
            @endforeach
            </tbody>
        </table>

@endif


@endsection