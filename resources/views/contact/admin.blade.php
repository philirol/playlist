@extends( session('visitors') == 1 ? 'layouts.appvisitors' : 'layouts.app' )

@section('content')

<x-flag-page position="left" type="{{ session('visitors') == 1 ? config('app.adminflagcolor') : config('app.adminflagcolor') }}" page="Contact Playlist" margbot="3"/>
<p>Contactez le webmaster.</p>
    @if (!session()->has('message'))
        <form action="{{ route('contact.admin') }}" method="POST">
        @include('includes.formcontact')
            
    @endif
@endsection