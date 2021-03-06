<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>    

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function vidSwap(vidURL) {
        var myVideo = document.getElementsByTagName('video')[0];
        myVideo.src = vidURL;
        myVideo.load();
        myVideo.play();
        document.getElementsById('video').focus();
        }
        var deleteLinks = document.querySelectorAll('.delete');
    </script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

@if(View::hasSection('style_photos'))
    <style type="text/css">
        #imgbook { width: 100%; }
    </style>
@endif

</head>
<body>
    <div id="wrap">
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: #fca733">  

            <div class="container">
                <div class="pull-left"><img width="32" height="32" src="{!! asset('images/logo3.png') !!}"/></div>
                <button class="navbar-toggler ml-auto hidden-sm-up float-xs-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ action('BookController@index', session('band_slug_for_visitors')) }}">@lang('Accueil')</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book.playlist') }}">Playlist</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/songs/pdf') }}">@lang('Imprimer Playlist')<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book.band') }}">@lang('Le groupe')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book.story') }}">Story</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book.photos') }}">Photos</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book.videos') }}">@lang('Vidéos')</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book.happenings') }}">@lang('Concerts')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book.contact') }}">Contact</a>
                        </li>
                    </ul>

                    <!-- Right Side (ml) Of Navbar -->              
                    <ul class="navbar-nav ml-auto">                         
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdownFlag" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img width="32" height="32" alt="{{ session('locale') }}"
                                        src="{!! asset('images/flags/' . session('locale') . '-flag.png') !!}"/>
                            </a>
                            <div id="flags" class="dropdown-menu" aria-labelledby="navbarDropdownFlag">
                                @foreach(config('app.locales') as $locale)
                                    @if($locale != session('locale'))
                                        <a class="dropdown-item" href="{{ route('language', $locale) }}">
                                            <img width="32" height="32" alt="{{ session('locale') }}"
                                                    src="{!! asset('images/flags/' . $locale . '-flag.png') !!}"/>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @if(View::hasSection('players'))                    
            <main class="py-3 container">
                <div class="row">
                    <div class="col-lg-8">                    
                        @if (session()->has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get(__('message')) }}
                            </div>
                        @endif
                        @if (session()->has('messageDanger'))
                            <div class="alert alert-danger" role="alert">
                                {{ session()->get(__('messageDanger')) }}
                            </div>
                        @endif
                        @yield('content')
                    </div>
                    <div>
                        <aside class="jumbotron">
                                <div>
                                    @php    
                                    if(isset($url)){ 
                                            
                                        $embed = Embed::make($url)->parseUrl();
                                        if ($embed) {
                                            $embed->setAttribute([
                                                'width' => 320,
                                                'id' => 'video'
                                                ]);
                                            echo $embed->getHtml();  
                                        }
                                    }
                                    @endphp
                                    {{-- substr(strrchr($songsub->file, '/'), 1) --}}
                                    <!-- <span class="note">ouvrir dans youtube</span> -->
                                </div>
                                <div class="pt-4">
                                    <video id='video' width="320" height="180" controls preload poster="{{asset('images/audiowave.png')}}" autoplay></video>
                                    <!-- <script>document.write(vidURL)</script> -->
                                </div>
                        </aside> 
                    </div>
                </div>
            </main>
        @else
            <main class="py-3">
                <div class="container">
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get(__('message')) }}
                        </div>
                    @endif
                    @if (session()->has('messageDanger'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get(__('messageDanger')) }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </main>
        @endif     
    </div>

    <footer id="foot">
        <div class="content-foot pt-2">
            Playlist@2020-VédasInformatique<br>
                <a href="{{ route('ml','visit') }}">Mentions légales</a>
                &nbsp; &nbsp; - &nbsp;&nbsp;
                <a href="{{ route('cf','visit') }}">Politique de confidentialité</a>
                &nbsp; &nbsp; - &nbsp;&nbsp;
                <a href="{{ route('contactwbm','visit') }}">Contact</a>
        </div>
    </footer>

</body>
</html>

@yield('scripts')