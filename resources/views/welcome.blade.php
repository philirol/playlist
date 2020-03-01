@extends('layouts.app')

@section('content')
<br><br>
<h1>New Playlist in building</h1>
<br><br><hr>
<h3>All rights reserved @Vedas informatique ;-)</h3>
<br>
<p>localization : {{  $locale = App::getLocale() }}</p>

<p>{{ __('messages.welcome') }}</p>


@endsection