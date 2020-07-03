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
    <div>

        <main class="h-100 ">

            <style>
                .logo {
                    width: 60px;
                    height: 60px;
                }

                .patient-slip {
                    max-width: 550px;
                }

                .patient-slip-body {
                    height: 650px;
                }

                ul,
                .card-footer {
                    list-style: none;
                    padding: 5px 10px !important;
                    font-size: 14px;
                }
            </style>

            <div class="patient-slip">
                <div class="card-header d-flex align-items-center justify-content-start">
                    <img src="{{asset('/img/logo.svg')}}" alt="Shifa Medical Trust" class="logo">
                    <div class="mt-3 ml-3">
                        <h3 class="h4 text-capitalize">{{config('app.name')}}</h3>
                        <p class="mt-n2 text-capitalize">{{config('app.address')}}</p>
                    </div>
                </div>
                <div class="card-body p-0 patient-slip-body">
                    <ul class="text-capitalize row">
                        <li class="col-md-6">
                            <span class="font-weight-bold">Name : </span>
                            <span class="ml-4">{{$patient->name . ' ' . $patient->guardian_name}}</span>
                        </li>
                        <li class="col-md-6">
                            <span class="font-weight-bold">Age : </span>
                            <span class="ml-4">{{$patient->age }}</span>
                        </li>
                        <li class="col-md-6">
                            <span class="font-weight-bold">Gender : </span>
                            <span class="ml-4">{{$patient->gender }}</span>
                        </li>

                        <li class="col-md-6">
                            <span class="font-weight-bold">Token# : </span>
                            <span class="ml-4">{{$patient->token }}</span>
                        </li>
                        <li class="col-md-6">
                            <span class="font-weight-bold">Invoice# : </span>
                            <span class="ml-4">{{$patient->id }}</span>
                        </li>
                        <li class="col-md-6">
                            <span class="font-weight-bold">Phone# : </span>
                            <span class="ml-4">{{$patient->phone }}</span>
                        </li>

                    </ul>
                </div>
                <div class="card-footer row">
                    <div class="col-md-6">
                        <span class="font-weight-bold">User : </span>
                        <span class="ml-4">{{$patient->user->name }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="font-weight-bold">Doctor : </span>
                        <span class="ml-4">{{$patient->doctor->name }}</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        // const printSlip = document.querySelector('.patient-slip');
        window.print();
    });
</script>
