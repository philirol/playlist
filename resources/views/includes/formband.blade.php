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


