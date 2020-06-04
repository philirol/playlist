@csrf
    <div class="form-group">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="@lang('Votre nom')" value="{{ old('name') }}" maxlenght="50" autofocus>
        @error('name')
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Votre Email')" value="{{ old('email') }}"  maxlenght="70">
        @error('email')
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <textarea name="message" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror" placeholder="@lang('Votre message...')" maxlenght="400">
        {{ old('message') }}
        </textarea>
        @error('message')
            <div class="invalid-feedback">
                {{ $errors->first('message') }}
            </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">@lang('Envoyer')</button>
</form>