@csrf

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Nom du groupe')</label>
    <div class="col-md-6">
        <input type="text" class="form-control @error('bandname') is-invalid @enderror" name="bandname" placeholder="Saisir un titre" value="{{ old('bandname') ?? $band->bandname }}">     
        @error('bandname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('bandname') }}</strong>
            </span>
        @enderror
    </div> 
</div>
{{-- 
<div class="form-group row">
<label for="departement" class="col-md-4 col-form-label text-md-right">@lang('Département du groupe')</label>
    <div class="col-md-6">
        <select class="custom-select form-control @error('departement_id') is-invalid @enderror" name="departement_code">
        <option value="" selected='selected'>
        {{ old('bandname') ?? $band->bandname }}
        -- Sélectionner un département --
        </option>
            @foreach($departement as $dep)
            <option value="{{ $dep->departement_code }}">{{  $dep->departement_code }} - {{  $dep->departement_nom }}</option>
            @endforeach                                    
        </select>
    </div>
</div> 
--}}