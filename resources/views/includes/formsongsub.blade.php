@csrf
        @if((isset($sub) && $sub=='lk') || $songsub->type==1)
        <div class="form-group">
            <label for="title">@lang('Titre pour le lien') : </label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="@lang('Saisir un titre')" value="{{ old('title') ?? $songsub->title }}" autofocus> 
            @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
            @enderror
        </div>
        @endif

        @if((isset($sub) && $sub=='lk') || $songsub->type==1)
        <div class="form-group">
            @if(isset($songsub->type))
            <label class="label">@lang('Mettre à jour le lien')</label>
            @else
            <label class="label">@lang('Ajouter un lien')</label>
            @endif
            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="@lang('Saisir un lien')" value="{{ old('url') ?? $songsub->url }}"> 
            @error('url')
            <div class="invalid-feedback">
                {{ $errors->first('url') }}
            </div>
            @enderror
        </div>
        @endif

        @if((isset($sub) && $sub=='fl')|| $songsub->type>1)        
            @if(isset($songsub->type))
                @lang('Browse pour changer')
            @endif
            <div class="form-group">                
                <div class="custom-file">
                    <input type="hidden" name="testfile" value="testfile">
                    <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" value="">
                    <label class="custom-file-label">
                    @if(isset($songsub->type))
                        {{ $songsub->title }}
                    @else  
                        @lang('Sélectionner un fichier')
                    @endif
                    </label>
                    @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                &nbsp;&nbsp;&nbsp;<span class="note">@lang('Extensions de fichiers autorisées') : 
                @php
                $string = "'mp3','ogg','wav','flac','mid','mp4','png','gif','jpg','jpeg','txt','xls','xlsx','ods','doc','docx','odt','pdf','gpx','gp3','gpa4','gp5'";
                $string = str_replace ("'", " ", $string);
                echo $string;
                @endphp
                </span>           
            </div>
        @endif         
            <br>
          <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="main" value="1" {{ $songsub->main == 1 ? 'checked' : '' }}>
                <label class="custom-control-label" for="customSwitch1">
                @lang('Mettre dans liste principale et la playlist du book').                
                </label>              
          </div>