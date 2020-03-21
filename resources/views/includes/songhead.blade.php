<h4>{{ $song->title }}</h4>
    <p>@lang('Dans') {{ $song->list }}. @lang('Posté par') {{ $song->user->name }} @lang('le') {{ $song->created_at->formatLocalized('%d %B %Y') }}</p>
    @if ($song->comments)
    <p><strong>@lang('Commentaires sur le morceau') :</strong> {{ $song->comments }}</p>
    @else
    <p>@lang('Il n\'y a pas de commentaires pour ce morceau')</p>
    @endif