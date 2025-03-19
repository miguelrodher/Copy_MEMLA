<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="MEMLA methodology | Researcher | Machine Learning | Artificial Intelligence | Data Science | Knowledge Discovery | #MEMLAmethodology | Eddy Sánchez-DelaCruz | Cecilia-Irene Loeza-Mejía | César Primero-Huerta">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $scripts??'' }}

</head>
<body class="font-sans text-gray-900 antialiased">

<header class="fixed top-0 z-10 w-full" x-data="{ open: false }" >
    <link rel="stylesheet" href="{{ asset("css/styles.css") }}">
    <div class="pt-6 bg-gray-900">
        <nav class="relative flex items-center justify-between px-4 mx-auto max-w-7xl sm:px-6" aria-label="Global">
            <div class="flex items-center flex-1">
                <div class="flex items-center justify-between w-full md:w-auto">
                    <a href="{{url("/")}}" class="text-base font-medium text-white hover:text-gray-300">


                        <img class="w-auto h-12 sm:h-10" src="{{asset("img/template/logo.svg")}}" alt="">

                    </a>
                    <div class="flex items-center -mr-2 md:hidden">
                        <button type="button" class="inline-flex items-center justify-center p-2 text-gray-400 bg-gray-900 rounded-md focus-ring-inset hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-white" aria-expanded="false" @click="open=true">
                            <span class="sr-only">Open main menu</span>
                            <!-- Heroicon name: outline/bars-3 -->
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="hidden space-x-8 md:ml-10 md:flex">
                    <a href="{{url('/#publications')}}" class="text-base font-medium text-white hover:text-gray-700">Publications</a>

                    <a href="{{url('/#about_memla')}}" class="text-base font-medium text-white hover:text-gray-700">About MEMLA</a>

                    <a href="{{url('/#about_team')}}" class="text-base font-medium text-white hover:text-gray-700">About Us</a>

                    <script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('Support Me on Ko-fi', '#f57315', 'F2F0R5ZF2');kofiwidget2.draw();</script>

                    <div class="animation start-ho"></div>
                </div>

                {{-- ! Inicio sesion / Registrarse --}}
                {{-- <div x-show="open" x-on:click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <!-- Active: "bg-gray-100", Not Active: "" -->
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                </div> --}}
            </div>
            {{-- ! Se añadio boton de logout si el usuario esta loggeado --}}
            <div class="hidden md:flex md:items-center md:space-x-10">

                @if (Route::has('login'))
                    @auth
                        {{-- <a href="{{ url('/dashboard') }}" class="block w-full px-4 py-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-100 to-memla-200 hover:from-teal-600 hover:to-cyan-700">Dashboard</a> --}}
                        <div>
                            <form method="POST" action="{{ route('logout') }} " class="block px-4 py-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600"  x-data>
                                @csrf
                                <button>
                                    logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-base font-medium text-white hover:text-gray-300">
                            Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block px-4 py-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
    </div>

    <!--
      Mobile menu, show/hide based on menu open state.

      Entering: "duration-150 ease-out"
        From: "opacity-0 scale-95"
        To: "opacity-100 scale-100"
      Leaving: "duration-100 ease-in"
        From: "opacity-100 scale-100"
        To: "opacity-0 scale-95"
    -->
    <div class="absolute inset-x-0 top-0 p-2 transition origin-top transform md:hidden sm:hidden" x-show="open" @click.away="open=false" >
        <div class="overflow-hidden bg-white rounded-lg shadow-md ring-1 ring-black ring-opacity-5">
            <div class="flex items-center justify-between px-5 pt-4">
                <div>

                </div>
                <div class="-mr-2">
                    <button type="button" class="inline-flex items-center justify-center p-2 text-gray-400 bg-white rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-memla-600" @click="open=false">
                        <span class="sr-only">Close menu</span>
                        <!-- Heroicon name: outline/x-mark -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="pt-5 pb-6">
                <div class="px-2 space-y-1">
                    <a href="{{url('/#publications')}}" class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-50">Publications</a>
                    <a href="{{url('/#about_memla')}}" class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-50">About MEMLA</a>
                    <a href="{{url('/#about_team')}}" class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-50">About us</a>
                    <script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('Support Me on Ko-fi', '#f57315', 'F2F0R5ZF2');kofiwidget2.draw();</script>

                </div>
                @if (Route::has('login'))
                    @auth
                        <div class="px-5 mt-6">
                            <a href="{{ url('/dashboard') }}" class="block w-full px-4 py-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-400 to-memla-500 hover:from-memla-600 hover:to-memla-700">Dashboard</a>
                        </div>
                    @else
                        <div class="px-2 space-y-1">
                            <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-50">Login</a></p>
                        </div>
                        @if (Route::has('register'))
                            <div class="px-5 mt-6">
                                <a href="{{ route('register') }}" class="block w-full px-4 py-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-400 to-memla-500 hover:from-memla-800 hover:to-memla-900">Resgister</a>
                            </div>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</header>
    <div class="w-full min-h-screen  sm:justify-center items-center pt-10 bg-gray-100 dark:bg-gray-900  mt-10 md:mt-5">
        {{ $slot }}
    </div>
</body>
</html>
