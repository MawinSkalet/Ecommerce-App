@push('head')
    <link rel="preload" as="image" href="{{ asset('images/bg-uma.jpg') }}">
@endpush
<x-layouts.shop title="Home">
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-cover" style="background-image: url('{{ asset('images/bg-uma.jpg') }}'); background-position: center 20%;">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center md:text-right md:ml-auto md:max-w-xl">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
                    Find Your Perfect
                    <span class="block text-amber-300">Uma Musume</span>
                </h1>
                <p class="text-lg md:text-xl text-white/80 max-w-2xl mx-auto mb-8">
                    Discover and purchase unique, champion-quality horses from our curated collection. Every horse has its own story waiting for you.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-end">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-xl transition shadow-lg text-lg">
                        Browse Horses
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-white font-semibold rounded-xl hover:bg-white/10 transition text-lg">
                            Create Account
                        </a>
                    @endguest
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 dark:from-gray-900 to-transparent"></div>
    </section>

    {{-- Featured Horses --}}
    @if($featured->count() > 0)
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Featured Horses</h2>
            <p class="text-gray-500 dark:text-gray-400">Hand-picked champions for discerning buyers</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featured as $listing)
                <a href="{{ route('products.show', $listing) }}" class="group">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700 group-hover:-translate-y-1">
                        <div class="aspect-[4/3] overflow-hidden bg-gray-100 dark:bg-gray-700">
                            <img src="{{ $listing->horse->photo_url ?? 'https://placehold.co/600x400/e2e8f0/94a3b8?text=No+Photo' }}"
                                 alt="{{ $listing->horse->registered_name }}"
                                 loading="lazy"
                                 decoding="async"
                                 width="600" height="400"
                                 class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 text-xs font-medium rounded-full">{{ $listing->horse->breed?->breed_name ?? 'Unknown' }}</span>
                                <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-medium rounded-full">{{ ucfirst($listing->horse->sex) }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $listing->horse->registered_name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">{{ $listing->horse->stable?->stable_name ?? 'Unknown Stable' }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-emerald-600 dark:text-emerald-400">¥{{ number_format($listing->list_price) }}</span>
                                <span class="text-sm text-green-600 dark:text-green-400 font-medium">Available</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Latest Listings --}}
    @if($newest->count() > 0)
    <section class="bg-white dark:bg-gray-800 border-y border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Newest Arrivals</h2>
                    <p class="text-gray-500 dark:text-gray-400">The latest horses added to our collection</p>
                </div>
                <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center text-emerald-600 dark:text-emerald-400 font-medium hover:text-emerald-700 transition">
                    View All
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($newest as $listing)
                    <a href="{{ route('products.show', $listing) }}" class="group flex bg-gray-50 dark:bg-gray-700/50 rounded-xl overflow-hidden hover:shadow-md transition-all duration-300 border border-gray-100 dark:border-gray-600">
                        <div class="w-32 h-32 flex-shrink-0 overflow-hidden bg-gray-200 dark:bg-gray-600">
                            <img src="{{ $listing->horse->photo_url ?? 'https://placehold.co/200x200/e2e8f0/94a3b8?text=No+Photo' }}"
                                 alt="{{ $listing->horse->registered_name }}"
                                 loading="lazy"
                                 decoding="async"
                                 width="200" height="200"
                                 class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4 flex flex-col justify-center">
                            <span class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">{{ $listing->horse->breed?->breed_name ?? 'Unknown' }}</span>
                            <h3 class="font-bold text-gray-900 dark:text-white">{{ $listing->horse->registered_name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $listing->horse->stable?->stable_name }}</p>
                            <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400 mt-1">¥{{ number_format($listing->list_price) }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="relative bg-gradient-to-r from-emerald-500 to-teal-600 rounded-3xl p-8 md:p-12 text-center overflow-hidden">
            <div class="absolute inset-0 bg-[url('{{ asset('images/bg-uma.jpg') }}')] bg-cover bg-center opacity-10"></div>
            <div class="relative">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Ready to Own a Champion?</h2>
                <p class="text-white/80 mb-6 max-w-xl mx-auto">Sign up today and browse our exclusive collection of Uma Musume horses. Every horse is unique — once sold, it's gone forever!</p>
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-amber-400 hover:bg-amber-300 text-gray-900 font-bold rounded-xl transition shadow-lg">
                        Get Started
                    </a>
                @else
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-3 bg-amber-400 hover:bg-amber-300 text-gray-900 font-bold rounded-xl transition shadow-lg">
                        Browse Horses
                    </a>
                @endguest
            </div>
        </div>
    </section>
</x-layouts.shop>
