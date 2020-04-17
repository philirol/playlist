@extends('layouts.app')

@section('content')
<div class="bg-info rounded-lg">
<table class="table text-white">
  <tr>
    <td class="align-middle"><h4>Subscriptions</h4> <h6></td>
  </tr>
</table>
</div>

<table class="table table-striped">
    <thead class="thead-info">
        <tr>
            <th scope="col">id</th>
            <th scope="col">customer</th>
            <th scope="col">period end</th>
            <th scope="col">Active - Plan</th>
        </tr>
    </thead>
    <tbody>
    @foreach($subscriptions as $subscr)
        <tr>
            <td>{{ $subscr->id }}</td>
            <td>
            {{ $subscr->customer }}
            </td>
            <td>{{ date('d m Y', $subscr->current_period_end) }}</td>
            <td>
                @foreach($subscr->items as $data) 
                {{ $data->plan->active }} - 
                {{ $data->plan->nickname }}
                @endforeach
            </td>
            <td>
                <form action="#" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <div class="col-md-4">
                        <div class="login-go-div">
                            <input type="image" src="{{asset('images/trash2a.png')}}" class="login-go"
                                onmouseover="this.src='{{asset('images/trash2b.png')}}'"
                                onmouseout="this.src='{{asset('images/trash2a.png')}}'" title="@lang('Supprimer')"/>
                        </div>
                    </div>           
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection