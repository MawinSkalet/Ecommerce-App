<x-layouts.shop :title="$listing->horse->registered_name">
    @vite('resources/js/horse-stats.jsx')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-emerald-600">Home</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('products.index') }}" class="hover:text-emerald-600">Horses</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-900 dark:text-white font-medium">{{ $listing->horse->registered_name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            {{-- Image --}}
            <div class="bg-gray-100 dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 flex items-center justify-center">
                <img src="{{ $listing->horse->photo_url ?? 'https://placehold.co/600x400/e2e8f0/94a3b8?text=No+Photo' }}"
                     alt="{{ $listing->horse->registered_name }}"
                     loading="eager"
                     decoding="async"
                     fetchpriority="high"
                     width="600" height="400"
                     class="w-full h-auto max-h-[500px] object-contain">
            </div>

            {{-- Details --}}
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 text-sm font-medium rounded-full">{{ $listing->horse->breed?->breed_name ?? 'Unknown Breed' }}</span>
                    @if($listing->status === 'active')
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 text-sm font-medium rounded-full">Available</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300 text-sm font-medium rounded-full">{{ ucfirst($listing->status) }}</span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">{{ $listing->horse->registered_name }}</h1>

                <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mb-6">¥{{ number_format($listing->list_price) }}</p>

                {{-- Horse Info Table --}}
                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700 mb-6">
                    <div class="flex justify-between px-5 py-3">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Sex</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst($listing->horse->sex) }}</span>
                    </div>
                    <div class="flex justify-between px-5 py-3">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Birth Date</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $listing->horse->birth_date ? $listing->horse->birth_date->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between px-5 py-3">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Breed</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $listing->horse->breed?->breed_name ?? 'Unknown' }}</span>
                    </div>
                    <div class="flex justify-between px-5 py-3">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Origin</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $listing->horse->breed?->origin_country ?? 'Unknown' }}</span>
                    </div>
                    <div class="flex justify-between px-5 py-3">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Stable</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $listing->horse->stable?->stable_name ?? 'Unknown' }}</span>
                    </div>
                    <div class="flex justify-between px-5 py-3">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Province</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $listing->horse->stable?->province ?? 'Unknown' }}</span>
                    </div>
                    <div class="flex justify-between px-5 py-3">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Status</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst($listing->horse->status) }}</span>
                    </div>
                </div>

                {{-- Description --}}
                @if($listing->horse->description)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Description</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $listing->horse->description }}</p>
                    </div>
                @endif

                {{-- Add to Cart --}}
                @if($listing->status === 'active')
                    @auth
                        <form method="POST" action="{{ route('cart.add', $listing) }}">
                            @csrf
                            <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition text-lg shadow-lg hover:shadow-xl">
                                Add to Cart 🛒
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition text-lg shadow-lg hover:shadow-xl text-center">
                            Login to Purchase
                        </a>
                    @endauth
                @else
                    <div class="w-full py-4 bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 font-bold rounded-xl text-lg text-center cursor-not-allowed">
                        Not Available
                    </div>
                @endif
            </div>
        </div>

        {{-- Uma Musume Attributes Chart --}}
        <div class="mt-10">
            <div data-horse-stats
                 data-horse-id="{{ $listing->horse->id }}"
                 data-horse-name="{{ $listing->horse->registered_name }}"
                 data-stat-speed="{{ $listing->horse->stat_speed }}"
                 data-stat-stamina="{{ $listing->horse->stat_stamina }}"
                 data-stat-power="{{ $listing->horse->stat_power }}"
                 data-stat-guts="{{ $listing->horse->stat_guts }}"
                 data-stat-wisdom="{{ $listing->horse->stat_wisdom }}">
            </div>
        </div>
    </div>
</x-layouts.shop>
