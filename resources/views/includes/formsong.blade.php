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
{{-- 
<div class="jumbotron">
    @if($sub=='lk')
        <div class="form-group">
            <label class="label">@lang('Ajouter un lien')</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="@lang('Saisir un lien')" value=""> 
            @error('url')
            <div class="invalid-feedback">
                {{ $errors->first('url') }}
            </div>
            @enderror
        </div>
        @elseif($sub=='fl')
        <div class="form-group">
            <label class="label">@lang('Ajouter un fichier')</label>
            <div class="custom-file">
                <input type="file" name="songfile" class="custom-file-input @error('songfile') is-invalid @enderror">
                <label class="custom-file-label">@lang('Sélectionner un fichier')</label>
                @error('songfile')
                    <div class="invalid-feedback">
                        {{ $errors->first('songfile') }}
                    </div>
                @enderror
            </div>
        </div>
    @endif
</div>
--}}
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
