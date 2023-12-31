<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" href="{{ asset('images/LogoMYCL.png') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Mycotech - Admin</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/admin_dashboard') }}">
                    Mycotech - Admin
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/admin_dashboard') }}">Home</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/baglog') }}">Baglog</a>
                            </li> --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="baglogDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Substrate Bag
                                </a>
                                <div class="dropdown-menu" aria-labelledby="baglogDropdown">
                                    <a class="dropdown-item" href="{{ url('/admin/baglog/report') }}">Report</a>
                                    <a class="dropdown-item" href="{{ url('/admin/baglog/') }}">Chart</a>
                                    <a class="dropdown-item" href="{{ url('/admin/baglog/data-recipe') }}">Data Recipe</a>
                                    <a class="dropdown-item" href="{{ url('/operator/baglog/inkubasi-baglog') }}">Monitoring Inkubasi</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="myleaDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Mylea
                                </a>
                                <div class="dropdown-menu" aria-labelledby="myleaDropdown">
                                    <a class="dropdown-item" href="{{ url('/admin/mylea/report') }}">Report</a>
                                    <a class="dropdown-item" href="{{ url('/admin/mylea') }}">Chart</a>
                                    <a class="dropdown-item" href="{{ url('/admin/mylea/harvest-schedule') }}">Harvest Schedule</a>
                                </div>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/post-treatment-index') }}">Post Treatment</a>
                            </li> --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="postTreatmentDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Post Treatment
                                </a>
                                <div class="dropdown-menu" aria-labelledby="postTreatmentDropdown">
                                    <a class="dropdown-item" href="{{ url('/post-treatment/mylea-harvest') }}">Harvest</a>
                                    <a class="dropdown-item" href="{{ url('/post-treatment/I') }}">Scouring</a>
                                    <a class="dropdown-item" href="{{ url('/post-treatment/II') }}">Wet Process</a>
                                    <a class="dropdown-item" href="{{ url('/curing/') }}">Curing</a>
                                    <a class="dropdown-item" href="{{ url('/reinforce') }}">Reinforce</a>
                                    <a class="dropdown-item" href="{{ url('/post-treatment/III') }}">Dry Process</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="environmentDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Environment
                                </a>
                                <div class="dropdown-menu" aria-labelledby="environmentDropdown">
                                    <a class="dropdown-item" href="{{ url('/admin/environment/') }}">Temperature Humidity</a>
                                    <a class="dropdown-item" href="{{ url('/admin/environment/co2') }}">CO2</a>
                                </div>
                            </li>
                            {{-- <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Biobo</a>
                            </li> --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('/operator_dashboard')}}">Operator</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
