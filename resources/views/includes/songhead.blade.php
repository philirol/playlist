<div class="p-2 bg-{{config('app.appflagcolor')}} rounded-lg text-white">
      <div class="d-inline-block"><h4>{{ $song->title }}</h4><small>@lang('Posté dans ') {{ $song->list }} @lang('le') {{ Carbon\Carbon::parse($song->created_at)->formatLocalized('%d %B %Y') }} - <u>{{ $song->user->name }}</u></small></div>
</div>