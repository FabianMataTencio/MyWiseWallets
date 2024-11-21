<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WiseWallet</title>

    <link rel="icon" href="{{asset('imgs/logo.png')}}" type="image/png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body>
    <!-- Alpine.js Data -->
    <div class="flex" id="wrapper" x-data="{ isOpen: true, mobileMenuOpen: false }">

        <!-- Sidebar for big screens -->
        <aside id="sidebar" class="hidden sm:block h-screen bg-gray-900 overflow-y-auto transition-all duration-300" :class="isOpen ? 'w-64' : 'w-20'">
            <a href="{{route('welcome')}}" class="w-full h-auto p-4 flex items-center justify-start">
                    <img src="{{ asset('imgs/logo.png') }}" class="h-11 w-11 transition-transform duration-300" alt="Logo">
                    <span class="ml-2 text-white font-medium transition-opacity duration-300" :class="isOpen ? 'opacity-100' : 'opacity-0'">WiseWallet</span>
            </a>
            <ul class="mt-4 space-y-2 tracking-wide">
                <li class="min-w-max">
                    <a href="{{route('welcome')}}"
                        class="bg group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                        <img src="{{asset('imgs/home.png')}}"
                            class="w-9" alt="home">
                        <span class="text-gray-300 transition-opacity duration-300" :class="isOpen ? 'opacity-100' : 'opacity-0'">{{__("Home")}}</span>
                    </a>
                </li>
                @auth
                    <li class="min-w-max">
                        <a href="{{route('incomes.index')}}"
                            class="bg group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                            <img src="{{asset('imgs/transactions.png')}}"
                                class="w-9" alt="transactions">
                            <span class="text-gray-300 transition-opacity duration-300" :class="isOpen ? 'opacity-100' : 'opacity-0'">{{__("Transactions")}}</span>
                        </a>
                    </li>
                    <li class="min-w-max">
                        <a href="{{route('economicgoals.index')}}"
                            class="bg group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                            <img src="{{asset('imgs/goals.png')}}"
                                class="w-9" alt="goals">
                            <span class="text-gray-300 transition-opacity duration-300" :class="isOpen ? 'opacity-100' : 'opacity-0'">{{__("Economic Goals")}}</span>
                        </a>
                    </li>
                    <li class="min-w-max">
                        @if (auth()->user()->unreadNotifications->count())
                            <a href="{{route('notifications.index')}}"
                                class="bg group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                <img src="{{asset('imgs/notifications.png')}}"
                                    class="w-9" alt="goals">
                                    <span class="text-gray-300 transition-opacity duration-300" :class="isOpen ? 'opacity-100' : 'opacity-0'">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                        @choice('Notification|Notifications', auth()->user()->unreadNotifications->count())
                                    </span>
                            </a>
                        @else
                            <a href="{{route('notifications.index')}}"
                                class="bg group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                <img src="{{asset('imgs/noNotification.png')}}"
                                    class="w-9" alt="goals">
                                <span class="text-gray-300 transition-opacity duration-300" :class="isOpen ? 'opacity-100' : 'opacity-0'">{{ auth()->user()->unreadNotifications->count() }} {{__('Notifications')}}</span>
                            </a>
                        @endif
                        @if (auth()->user()->rol_id == 1)
                            <li class="min-w-max">
                                <a href="{{route('reviews_admin.index')}}"
                                    class="bg group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">     
                                    <x-icons.admin-reviews-icon class="!w-9 !h-9" />
                                    <span class="text-gray-300 transition-opacity duration-300" :class="isOpen ? 'opacity-100' : 'opacity-0'">{{__("Reviews Admin")}}</span>
                                </a>
                            </li>
                            <li class="min-w-max">
                                <a href="{{route('users_admin.index')}}"
                                    class="bg group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                    <x-icons.user-icon class="!w-9 !h-9"/>
                                    <span class="text-gray-300 transition-opacity duration-300" :class="isOpen ? 'opacity-100' : 'opacity-0'">{{__("Users Admin")}}</span>
                                </a>
                            </li>
                        @endif
                    </li>
                @endauth
                <li class="min-w-max">
                    <a href="{{route('reviews.index')}}"
                        class="bg group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                        <img src="{{asset('imgs/reviews.png')}}"
                            class="w-9" alt="reviews">
                        <span class="text-gray-300 transition-opacity duration-300" :class="isOpen ? 'opacity-100' : 'opacity-0'">{{__("Reviews")}}</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Sidebar móvil -->
        <aside id="mobileSidebar" class="fixed inset-y-0 left-0 z-50 w-60 bg-gray-800 overflow-y-auto transition-transform transform duration-300 sm:hidden" 
               :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="w-full h-auto p-4 flex items-center justify-between">
                <a href="{{route('welcome')}}" class="flex items-center">
                    <img src="{{ asset('imgs/logo.png') }}" class="w-12" alt="Logo">
                    <span class="ml-2 font-medium text-white">WiseWallet</span>
                </a>
                <button @click="mobileMenuOpen = false" aria-label="Cerrar menú" class="text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <ul class="p-4 space-y-2">
                <li>
                    <a href="{{ route('welcome') }}"
                        class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md transition">
                        <img src="{{asset('imgs/home.png')}}" class="w-6" alt="home">
                        <span>{{__("Home")}}</span>
                    </a>
                </li>
                @auth
                    <li>
                        <a href="{{ route('incomes.index') }}"
                            class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md transition">
                            <img src="{{asset('imgs/transactions.png')}}" class="w-6" alt="transactions">
                            <span>{{__("Transactions")}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('economicgoals.index')}}"
                            class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md transition">
                            <img src="{{asset('imgs/goals.png')}}" class="w-6" alt="goals">
                            <span>{{__("Economic Goals")}}</span>
                        </a>
                    </li>
                    <li>
                        @if (auth()->user()->unreadNotifications->count())
                            <a href="{{route('notifications.index')}}"
                                class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md transition">
                                <img src="{{asset('imgs/notifications.png')}}" class="w-9" alt="goals">
                                <span>{{ auth()->user()->unreadNotifications->count() }} @choice('Noticacion|Notificaciones', auth()->user()->unreadNotifications->count())</span>
                            </a>
                        @else
                            <a href="{{route('notifications.index')}}"
                                class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md transition">
                                <img src="{{asset('imgs/noNotification.png')}}" class="w-6" alt="goals">
                                <span>{{ auth()->user()->unreadNotifications->count() }} {{__('Notifications')}}</span>
                            </a>
                        @endif
                    </li>
                    @if (auth()->user()->rol_id == 1)
                        <li>
                            <a href="{{route('reviews_admin.index')}}"
                                class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md transition">
                                <x-icons.admin-reviews-icon class="!w-6 !h-6" />
                                <span>{{__("Reviews Admin")}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('users_admin.index')}}"
                                class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md transition">
                                <x-icons.user-icon class="!w-6 !h-6"/>
                                <span>{{__("Users Admin")}}</span>
                            </a>
                        </li>
                        @endif
                @endauth
                <li>
                    <a href="{{route('reviews.index')}}"
                        class="flex items-center space-x-4 text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md transition">
                        <img src="{{asset('imgs/reviews.png')}}" class="w-6" alt="reviews">
                        <span>{{__("Reviews")}}</span>
                    </a>
                </li>
                <li class="border-t border-gray-700 p-4">
                    <div class="space-y-2">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center ml-4 w-full text-gray-300 hover:text-gray-400 transition focus:outline-none">
                                <span class="text-gray-300">{{__("Lenguage")}}</span>
                                <svg :class="{'transform rotate-180': open}" class="w-4 h-4 ml-2 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="mt-2 space-y-1 pl-4">
                                <a href="locale/en" class="flex items-center space-x-2 text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md">
                                    <img src="{{ asset('imgs/eeuu_flag.jpeg') }}" class="w-5 h-5" alt="EN" loading="lazy">
                                    <span>EN</span>
                                </a>
                                <a href="locale/es" class="flex items-center space-x-2 text-gray-300 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md">
                                    <img src="{{ asset('imgs/cr_flag.png') }}" class="w-5 h-5" alt="ES" loading="lazy">
                                    <span>ES</span>
                                </a>
                            </div>
                        </div>
                        @auth
                            <a href="{{ route('profile.edit') }}"
                               class="flex items-center space-x-2 text-gray-300 hover:text-white hover:bg-gray-700 py-2 rounded-md transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                                <span>{{__("Profile")}}</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center space-x-2 text-gray-300 hover:text-white hover:bg-gray-700 py-2 rounded-md transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                                    </svg>
                                    <span>{{__("Log Out")}}</span>
                                </button>
                            </form>
                        @endauth
                        @guest
                            <a class="mt-4 flex items-center font-bold text-gray-200 hover:text-white hover:bg-gray-700 py-2 rounded-md transition" href="/login">
                                {{__("Login")}}
                                <img class="w-4 ml-1" src="{{asset('imgs/login.png')}}" alt="login">
                            </a>
                        @endguest
                    </div>
                </li>
            </ul>
        </aside>

        <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false" class="fixed inset-0 bg-black opacity-50 z-40 sm:hidden" x-transition></div>

        <!-- Main Body -->
        <div id="body" class="w-full h-screen overflow-y-auto bg-gray-200 transition-all duration-300">
            <!-- Navbar -->
            <nav class="w-full h-auto p-4 flex justify-between items-center bg-gray-800">
                <div class="hidden sm:flex items-center">
                    <button @click="isOpen = !isOpen" class="text-white">
                        <img class="w-5 h-5 inline-block" src="{{ asset('imgs/arrows.png')}}" alt="Toggle Sidebar">
                    </button>
                </div>
                <div class="flex items-center">
                    <a href="{{route('welcome')}}"><img src="{{ asset('imgs/logo.png') }}" class="block sm:hidden h-10 w-10" alt="Logo"></a>
                </div>

                <!-- Botón de hamburguesa para pantallas pequeñas -->
                <div class="flex items-center sm:hidden">
                    <button @click="mobileMenuOpen = true" aria-label="Abrir menú" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': mobileMenuOpen, 'inline-flex': ! mobileMenuOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! mobileMenuOpen, 'inline-flex': mobileMenuOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="hidden sm:flex items-center space-x-6">
                    <x-dropdown width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{__('Lenguage')}}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <a class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="locale/en">
                                EN
                                <i class="inline-block ml-2">
                                    <img class="w-5 h-5 inline-block" src="{{ asset('imgs/eeuu_flag.jpeg')}}" alt="EN" loading="lazy">
                                </i>
                            </a>
                            <a class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="locale/es">
                                ES
                                <i class="inline-block ml-2">
                                    <img class="w-5 h-5 inline-block" src="{{ asset('imgs/cr_flag.png')}}" alt="ES" loading="lazy">
                                </i>
                            </a>
                        </x-slot>
                    </x-dropdown>
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
        
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
        
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
        
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
        
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @endauth
                    @guest
                        <a class="flex items-center font-bold text-gray-200" href="/login">
                            {{__("Login")}}
                            <img class="w-4 ml-1" src="{{asset('imgs/login.png')}}" alt="login">
                        </a>
                    @endguest
                </div>
            </nav>


            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
    @stack('scripts')
</body>
</html>
