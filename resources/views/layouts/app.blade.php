<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIS') }}</title>



    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/jquery.qtip.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.qtip.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

</head>

<body>
<div class="app overall-wrapper">
    @include('inc.navbar')
    <input type="checkbox" id="menu-icon">
    <div class="container-wrapper">
        <!-- Menu Icon -->
        <label for="menu-icon" class="menu-i-container">
            <div class="menu-icon--bars"></div>
            <div class="menu-icon--bars"></div>
            <div class="menu-icon--bars"></div>
        </label>
        <!-- Sidebar Menu -->
        <nav class="sidebar">
            <ul>
                <li>
                    <a href="/" data-parent="#sidebar"><i class="fas fa-tachometer-alt"></i> <span >Dashboard</span> </a>
                </li>
                @if(Auth::user()->role == 'superAdmin')
                    <li><a href="/users" data-parent="#sidebar"><i class="fas fa-user-tie"></i> <span class="d-none d-md-inline">Admins</span></a></li>
                @endif
                <li>
                    <a href="/serviceUsers" data-parent="#sidebar"><i class="fas fa-users"></i> <span>Service Users</span></a>
                </li>
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                    <li>
                        <a href="/supportWorkers" data-parent="#sidebar"><i class="fas fa-user-tie"></i> <span>Support Workers</span></a>
                    </li>
                    <li>
                        <a href="/supportRequests" data-parent="#sidebar"><i class="fa fa-th"></i> <span>Referrals</span></a>
                    </li>
                @endif
                @if(Auth::user()->role != 'superAdmin')
                    <li>
                        <a href="/sessions" data-parent="#sidebar"><i class="fas fa-calendar-alt"></i> <span>Calendar</span></a>
                    </li>
                @endif
            </ul>
        </nav>

        @yield('content')
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>

