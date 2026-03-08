@props(['title' => 'Horse Marketplace'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'UmaShop') }} - {{ $title }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    {{-- Navigation --}}
    <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <span class="text-2xl">🐴</span>
                        <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">UmaShop</span>
                    </a>
                    <div class="hidden sm:flex space-x-1">
                        <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }} transition">
                            Home
                        </a>
                        <a href="{{ route('products.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('products.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }} transition">
                            Horses
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    @auth
                        <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            @if(auth()->user()->cart && auth()->user()->cart->items->count() > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ auth()->user()->cart->items->count() }}</span>
                            @endif
                        </a>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50">
                                <a href="{{ route('member.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">My Account</a>
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Admin Dashboard</a>
                                @endif
                                <hr class="my-1 border-gray-200 dark:border-gray-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">Log Out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition">Log in</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition shadow-sm">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition>
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition>
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="text-2xl">🐴</span>
                        <span class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">UmaShop</span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Uma Musume-themed horse-selling web application. Browse, purchase, and own unique horses from our store.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-sm text-gray-900 dark:text-white mb-3">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Browse Horses</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-sm text-gray-900 dark:text-white mb-3">Account</h4>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        @auth
                            <li><a href="{{ route('member.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">My Account</a></li>
                            <li><a href="{{ route('cart.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Cart</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Login</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-6 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} UmaShop. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
