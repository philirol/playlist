@extends('layouts.app')

@section('content')
<x-flag-page position="left" type="{{config('app.appflagcolor')}}" page="Stripe Customers" margbot="3"/>
Supprimer les clients ici les suppriment sur Stripe.
<table class="table table-striped">
    <!-- <thead class="thead-dark">
        <tr>
            <th scope="col">id</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody> -->
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach($user->subscriptions as $activeplan) 
                {{ $activeplan->object }}
                @endforeach
            </td>
            <!-- <td>{{ $user->subscriptions }}</td> -->
            <td>
                <form action="{{ route('customer.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline;">
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