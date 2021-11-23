<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="footerFixed" id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand text-light" href="{{ route('spots.index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @can('admin')
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('admin.users.index') }}">管理画面</a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">{{ __('Contact') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('spots.create') }}">{{ __('Upoload') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('users.show', Auth::id() ) }}">{{ __('Mypage') }}</a>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li class="nav-item">
                            @include('notifications')
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @if (session('success'))
            <div class="alert alert-success mb-0" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session('danger'))
            <div class="alert alert-danger mb-0" role="alert">
                {{ session('danger') }}
            </div>
        @endif
        <main class="main">
            @yield('content')
        </main>
        
        <div class="space">
        </div>
        <footer class="footer">
            <p>Copyright © ○○○○ All Rights Reserved.</p>
        </footer>
    </div>

    

    {{-- マップ表示 --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyAH-4wGibx9deEeUHIyUEiTMqzzoaXgTqA&callback=pointMap" async defer>
    </script> --}}

    {{-- google map api用js --}}
    <script src="{{ asset('/js/result.js') }}"></script>

    {{-- 住所から場所検索 --}}
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyAH-4wGibx9deEeUHIyUEiTMqzzoaXgTqA&callback=initMap" async defer></script>

    {{-- 逆ジオコーディング --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH-4wGibx9deEeUHIyUEiTMqzzoaXgTqA&callback=initMap" async defer></script> --}}


    <script>
        // function setMap(){
        //     var textbox = document.getElementById("address");
        //     var value = textbox.value;

        //     var map = document.getElementById('map');
        //     var oldsrc = map.getAttribute('src');
        //     var newsrc = oldsrc.replace('大阪', value);
        //     map.setAttribute('src', newsrc);

        //     // XMLHttpRequestオブジェクトの作成
        //     var request = new XMLHttpRequest();

        //     // URLを開く
        //     request.open('GET', newsrc, true);

        //     // リクエストをURLに送信
        //     request.send();
        // }

    //   var SearchButton = document.getElementById("map-search");
    //   console.log(SearchButton);
    //   SearchButton.addEventListener('click', setMap);
    </script>
</body>
</html>


