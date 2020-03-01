@extends('layouts.app')

@section('content')
<h3>@lang('Villes avec groupes')</h3>
<br>
<table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">CP</th>
        <th scope="col">Ville</th>
        <th scope="col">Nbre groupe</th>
        <th scope="col">Groupe(s)</th>
        </tr>
    </thead>
    @foreach($villes as $ville)
        <tr>            
            <td>{{ $ville->ville_code_postal }}</td>     
            <td>{{ $ville->ville_nom }}</td>   
            <td>{{ $ville->bands_count }}</td>
            <td>
            @foreach($ville->bands as $band)
                {{ $band->bandname }},<br>
                @endforeach
            </td> 
            
        </tr>
    @endforeach  
</table>


@endsection