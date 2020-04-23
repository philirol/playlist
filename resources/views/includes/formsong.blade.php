@csrf
<div class="form-group">
    <label class="label">@lang('Titre')</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="@lang('Saisir un titre')" value="{{ old('title') ?? $song->title }}"> 
    @error('title')
    <div class="invalid-feedback">
        {{ $errors->first('title') }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label class="label">@lang('Commentaires')</label>
    <textarea class="form-control @error('comments') is-invalid @enderror" name="comments" placeholder="@lang('Saisir un commentaire')">{{ old('comments') ?? $song->comments }}</textarea>                
    @error('comments')
    <div class="invalid-feedback">
        {{ $errors->first('comments') }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label class="label">@lang('Mettre dans') :</label>
    <select class="custom-select form-control @error('list') is-invalid @enderror" name="list">
        @foreach($song->getListOptions() as $key => $value)
        <option value="{{ $key }}" {{ $song->list == $value ? 'selected' : ''}}>{{ $value }}</option>
        @endforeach
    </select>
    @error('list')
    <div class="invalid-feedback">
        {{ $errors->first('list') }}
    </div>
    @enderror
</div>
@if($song->title)
<div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="mailtomembers" value="1">
    <label class="custom-control-label" for="customSwitch1">
        @lang('Notifier les membres')&nbsp;
        <img src="{{asset('images/interog.png')}}" width="22" height="22" title="@lang('Les membres du groupe seront avertis par mail de la modification')">
    </label>              
</div>
@endif
