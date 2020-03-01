@csrf
<div class="form-group">
    <label class="label">@lang('Nom du groupe')</label>
    <input type="text" class="form-control @error('bandname') is-invalid @enderror" name="bandname" placeholder="Saisir un titre" value="{{ old('bandname') ?? $band->bandname }}"> 
    @error('bandname')
    <div class="invalid-feedback">
        {{ $errors->first('bandname') }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label class="label">@lang('Choisir la ville')</label>
    <select class="custom-select form-control @error('ville_id') is-invalid @enderror" name="ville">
        @foreach($villes as $ville)
        <option value="{{ $ville->id }}" {{ $band->ville_id == $ville->id ? 'selected' : ''}}>{{ $ville->ville_nom }}</option>
        @endforeach
    </select>
    @error('ville_id')
    <div class="invalid-feedback">
        {{ $errors->first('ville_id') }}
    </div>
    @enderror
</div>

