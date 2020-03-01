@csrf
<div class="form-group">
    <label class="label">@lang('Titre')</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Saisir un titre" value="{{ old('title') ?? $song->title }}"> 
    @error('title')
    <div class="invalid-feedback">
        {{ $errors->first('title') }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label class="label">Lien</label>
    <input type="text" class="form-control @error('reference') is-invalid @enderror" name="reference" placeholder="Saisir un lien" value="{{ old('reference') ?? $song->reference }}"> 
    @error('reference')
    <div class="invalid-feedback">
        {{ $errors->first('reference') }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label class="label">Note</label>
    <textarea class="form-control @error('note') is-invalid @enderror" name="note" placeholder="Saisir une note">{{ old('note') ?? $song->note }}</textarea>                
    @error('note')
    <div class="invalid-feedback">
        {{ $errors->first('note') }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label class="label">Mettre dans :</label>
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
