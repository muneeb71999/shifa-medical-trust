<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('img/logo.ico') }} type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="min-vh-100">
    <div id="app">
        @auth
        <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm text-white py-3">
            <div class="container-fluid">
                <a href="/" class="navbar-brand">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href={{ route('patients.index') }}>
                                Patients
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href={{ route('sales.index') }}>
                                Pharmacy
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('audit.index') }}>
                                Audit
                            </a>
                        </li>
                        @admin
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('employees.index') }}>
                                Employees
                            </a>
                        </li>

                        @endadmin
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item ">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle  text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endauth
        <main class="py-4 h-100 ">
            @yield('content')
        </main>
    </div>
</body>

</html>
