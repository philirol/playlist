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
   
        <div class="form-group">
            <label class="label">@lang('Ajouter un lien')</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="@lang('Saisir un lien')" value=""> 
            @error('url')
            <div class="invalid-feedback">
                {{ $errors->first('url') }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="label">@lang('Ajouter un fichier')</label>
            <div class="custom-file">
                <input type="hidden" name="testfile" value="testfile">
                <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror">
                <label class="custom-file-label">@lang('Sélectionner un fichier')</label>
                @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>            
        </div>
   
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
