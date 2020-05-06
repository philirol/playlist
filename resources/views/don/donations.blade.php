@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Faire un don')</h4></td>
  </tr>
</table>
</div>
<div class="py-4 row justify-content-center">
    <div class="col-md-8">
                @empty($donations)  
                    <p>@lang('Vous n\'avez effectué aucun don.')</p>             
                @else  
                    @foreach($donations as $donation)                                                     
                        <h5>@lang('Vous avez effectué un don de') {{ $donation->amount }} € @lang('le') {{ Carbon\Carbon::parse($donation->created_at)->format('d/m/Y') }}</h5>                    
                        <br>                         
                    @endforeach  
                @endempty
        <a href="javascript:history.back()" class="btn btn-outline-dark"><span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')</a>
    </div>
</div>

@endsection