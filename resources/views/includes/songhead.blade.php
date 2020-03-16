<h4>{{ $song->title }}&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ $song->url }}" target="_blank"><img src="{{asset('images/ytb.png')}}" alt="logo youtube" height="22" width="33"></a></h4>
    <p>@lang('Dans') {{ $song->list }}. @lang('Posté par') {{ $song->user->name }} @lang('le') {{ $song->created_at->formatLocalized('%d %B %Y') }}</p>
    @if ($song->comments)
    <p><strong>@lang('Commentaires') :</strong> {{ $song->comments }}</p>
    @else
    <p>@lang('Il n\'y a pas de commentaires pour ce morceau')</p>
    @endif