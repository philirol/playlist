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
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

    <!-- New Bootstrap menu déroulant marche pas si actif, à voir si on garde suite au changmenets css -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    
    <!-- Resident -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/> -->
   
    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/> -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ action('SongController@index', '1') }}">Playlist</a>
                <a class="navbar-brand" href="{{ action('SongController@index','0') }}">@lang('Projets')</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">@lang('Imprimer Playlist')<span class="sr-only">(current)</span></a>
                        </li>            
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.index') }}">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.create') }}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">@lang('Aide')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('banduser')}}">@lang('Le groupe')</a>
                        </li>
                        @if(Auth::check() and Auth::user()->admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.indexByAdmin') }}">@lang('Utilisateurs')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('band.index') }}">@lang('Groupes')</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ville.index') }}">@lang('Villes')</a>
                        </li>                      
                        @endif
                    </ul>

                    <!-- Right Side (ml) Of Navbar -->              
                     <ul class="navbar-nav ml-auto"> 

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">@lang('Connexion')</a>
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
        <main class="py-4 container">
            @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get(__('message')) }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>

