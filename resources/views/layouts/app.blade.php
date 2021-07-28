<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        @stack('style_tag')

        body {
            padding-top:80px;
        }

        .navbar {
            -webkit-transition:padding 0.2s ease;
            -moz-transition:padding 0.2s ease;
            -o-transition:padding 0.2s ease;
            transition:padding 0.2s ease;
        }

        .nav-item:hover{
            background-color: lightgray;
            border-radius: 5%;
        }

        .affix {
            padding-top: 0.2em !important;
            padding-bottom: 0.2em !important;
            -webkit-transition:padding 0.2s linear;
            -moz-transition:padding 0.2s linear;
            -o-transition:padding 0.2s linear;
            transition:padding 0.2s linear;
        }

        .main-section{
            background-color: #F8F8F8;
            margin-top:50px;
        }
        #cart{
            float:right;
            padding-right: 30px;
        }
        .btn{
            border:0px;
            margin:10px 0px;
            box-shadow:none !important;
        }
        #cart .dropdown-menu{
            padding: 20px;
            top: 30px !important;
            width: 400px !important;
            left: -150px !important;
            box-shadow: 0px 5px 30px black;
        }
        .total-header-section{
            border-bottom:1px solid #d2d2d2;
        }
        .total-section p{
            margin-bottom:20px;
        }
        .cart-detail{
            padding:15px 0px;
        }
        .cart-detail-img img{
            width:100%;
            height:100%;
            padding-left:15px;
        }
        .cart-detail-product p{
            margin:0px;
            color:#000;
            font-weight:500;
        }
        .cart-detail .price{
            font-size:12px;
            margin-right:10px;
            font-weight:500;
        }
        .cart-detail .count{
            color:#C2C2DC;
        }
        .checkout{
            border-top:1px solid #d2d2d2;
            padding-top: 15px;
        }
        .checkout .btn-primary{
            border-radius:50px;
            height:50px;
            padding-top: 12px;
        }
        #cart .dropdown-menu:before{
            content: " ";
            position:absolute;
            top:-20px;
            right:50px;
            border:10px solid transparent;
            border-bottom-color:#fff;
        }

        .error{
            color: #d01111;
        }

        #app{
            min-height: 89vh;
        }

    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md py-3 navbar-light fixed-top bg-light shadow-sm" data-toggle="affix" id="nav_container">
            <div class="container">
                <img src="{{ asset('images/main-logo.png') }}" height="50" alt="">
                <a class="navbar-brand" href="{{ route('home') }}">
                    Battledor Arena
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public_products') }}">
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public_clubs') }}">
                                Clubs
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public_matches') }}">
                                Matches
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public_tournaments') }}">
                                Tournaments
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public_players') }}">
                                Players
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public_about') }}">
                                About
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">




                        <li class="dropdown" id="cart">
                            @include('layouts.cart')

                        </li>



                        <!-- Authentication Links -->
                        @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>

                        @else
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                                    <a class="dropdown-item" href="{{ route('user_profile') }}">Profile</a>


                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item list-unstyled">Logout</button>
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

    </div>


    <footer class="bg-light py-4">
        <div class="container text-center">
            <p class="font-italic text-primary mb-0 font-weight-bold">&copy; Copyrights Battledor Arena All rights reserved.</p>
        </div>
    </footer>

    <style>

    #nav_container {
            background-image: url("{{ asset('images/nav-bg.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

    </style>

    <script>

        @if(session('info'))
        bootbox.alert("{{ session('info') }}");
        @endif

        @if(session('error'))
        bootbox.alert("<span class = \"text-danger\">{{ session('error') }}</span>");
        @endif

        $(document).ready(function() {

            var toggleAffix = function(affixElement, scrollElement, wrapper) {

                var height = affixElement.outerHeight(),
                    top = wrapper.offset().top;

                if (scrollElement.scrollTop() >= top){
                    wrapper.height(height);
                    affixElement.addClass("affix");
                }
                else {
                    affixElement.removeClass("affix");
                    wrapper.height('auto');
                }

            };


            $('[data-toggle="affix"]').each(function() {
                var ele = $(this),
                    wrapper = $('<div></div>');

                ele.before(wrapper);
                $(window).on('scroll resize', function() {
                    toggleAffix(ele, $(this), wrapper);
                });

                // init
                toggleAffix(ele, $(window), wrapper);
            });


            window.AOS.init();

        });

    </script>



</body>
</html>
