@extends( $book == 'app' ? 'layouts.app' : 'layouts.appvisitors' )

@section('content')

<x-flag-page position="left" type="{{ $book == 'visit' ? config('app.visitorflagcolor') : config('app.appflagcolor') }}" page="Contact Playlist" margbot="3"/>
<p>@lang('Contactez le webmaster du site Playlist.')</p>
    @if (!session()->has('message'))
        <form action="{{ route('contact.store') }}" method="POST">
        @include('includes.formcontact')
            
    @endif
@endsection