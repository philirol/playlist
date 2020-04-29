@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>@lang('Liste des fichiers')</h4></td>
  </tr>
</table>
</div>

<div class="py-2 row justify-content-center">
    <div class="col-md-8">
        @foreach($files_with_size as $item)
        {{ substr($item['name'], stripos($item['name'],'/') +1, -15) }} - {{ $item['size'] }}
        <br>
        @endforeach
    
    </div>
</div>

@endsection
