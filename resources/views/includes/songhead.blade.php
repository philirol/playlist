<h4>{{ $song->title }}</h4>
    <p>@lang('Dans') {{ $song->list }}. @lang('Posté par') <u>{{ $song->user->name }}</u> @lang('le') {{ Carbon\Carbon::parse($song->created_at)->formatLocalized('%d %B %Y') }}</p>
    @if ($song->comments)
    <div class="jumbotron">
    <h4>@lang('Notes des membres'):</h4>
    <p>{{ $song->comments }}</p>...
    </div>
    @else
    <p>@lang('Il n\'y a pas de commentaires pour ce morceau')</p>
    @endif