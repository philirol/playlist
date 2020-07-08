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
    <link rel="icon" href="{{ URL::asset('images/favicon.png') }}" type="image/x-icon"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

@if(View::hasSection('style_photos'))
    <style type="text/css">
        #imgbook { width: 100%; }
    </style>
@endif

</head>
<body>
    <div id="wrap">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            
            <div class="container">               
                <div class="pull-left" width="32" height="32">
                    <a href="{{ route('songs.index') }}"><img width="32" height="32" src="{!! asset('images/logo3.png') !!}"/></a>
                </div>
                <button class="navbar-toggler ml-auto hidden-sm-up float-xs-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                        <a class="nav-link" href="{{ action('SongController@index', '1') }}">Playlist</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ action('SongController@index', '0') }}">Projets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/songs/pdf') }}">@lang('Imprimer Playlist')<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('band.show') }}">@lang('Le groupe')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.create') }}">Contact</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('hlp') }}">@lang('Aide')</a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('photos.index') }}">Book</a>
                        </li> -->

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Book<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ route('photos.index') }}" class="dropdown-item">Photos</a>
                            <a href="{{ route('videos.index') }}" class="dropdown-item">Videos</a>
                            <a href="{{ route('story.index') }}" class="dropdown-item">Story</a>
                            <a href="{{ route('happenings.index') }}" class="dropdown-item">Happenings</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visitors') }}">@lang('Visiteurs')</a>
                        </li>
                    </ul>

                    <!-- Right Side (ml) Of Navbar -->              
                     <ul class="navbar-nav ml-auto"> 

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <input type="button" class="btn btn-light mt-2" value="@lang('Connexion')" onclick="login()">
                                <script>
                                function login(){ location.href = "{{ route('login') }}";} 
                                </script>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">@lang('Inscription')</a>
                                </li>
                            @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }}<span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('user.index') }}">@lang('Profil')</a>
                                        <a class="dropdown-item" href="{{ route('plans.index') }}">@lang('Abonnement')</a>
                                        <a class="dropdown-item" href="{{ route('don.donation') }}">@lang('Don')</a>
                                        
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            @lang('Se déconnecter')
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                        @endguest
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
        @if(Auth::check() and Auth::user()->admin)
            <nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: #ddd78f;">
                <div class="container">
                    <span class="navbar-brand">Admin</span>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">                   
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.indexByAdmin', ['slug' => 'demo-band','sort' => 'id']) }}">@lang('Utilisateurs')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('band.index', ['sort' => 'id']) }}">@lang('Groupes')</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Stripe
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('plans.create') }}">@lang('Stripe products')</a>
                                    <a class="dropdown-item" href="{{ route('subscr.index') }}">@lang('Stripe clients')</a>
                                    <a class="dropdown-item" href="{{ route('subscr.subscrList') }}">@lang('Subscriptions')</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @endif
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
            
                <a href="{{ route('ml','app') }}">Mentions légales</a>
                &nbsp; &nbsp; - &nbsp;&nbsp;
                <a href="{{ route('cf','app') }}">Politique de confidentialité</a>
                &nbsp; &nbsp; - &nbsp;&nbsp;
                <a href="{{ route('cgv','app') }}">CGV</a>
                &nbsp; &nbsp; - &nbsp;&nbsp;
                <a href="{{ route('contactwbm','app') }}">Contact</a>
        </div>
    </footer>

</body>
</html>

@yield('scripts')