<x-layouts.shop title="Browse Horses">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Browse Horses</h1>
            <p class="text-gray-500 dark:text-gray-400">Find your perfect horse from our collection</p>
        </div>

        {{-- Filters --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 mb-8">
            <form method="GET" action="{{ route('products.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by name..."
                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <select name="breed" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">All Breeds</option>
                    @foreach($breeds as $breed)
                        <option value="{{ $breed->id }}" {{ request('breed') == $breed->id ? 'selected' : '' }}>{{ $breed->breed_name }}</option>
                    @endforeach
                </select>
                <select name="sort" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Newest First</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
                <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'breed', 'sort']))
                    <a href="{{ route('products.index') }}" class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition text-center">Clear</a>
                @endif
            </form>
        </div>

        {{-- Results --}}
        @if($listings->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($listings as $listing)
                    <a href="{{ route('products.show', $listing) }}" class="group">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700 group-hover:-translate-y-1">
                            <div class="aspect-[4/3] overflow-hidden bg-gray-100 dark:bg-gray-700">
                                <img src="{{ $listing->horse->photo_url ?? 'https://placehold.co/600x400/e2e8f0/94a3b8?text=No+Photo' }}"
                                     alt="{{ $listing->horse->registered_name }}"
                                     loading="lazy"
                                     decoding="async"
                                     width="600" height="400"
                                     class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-5">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 text-xs font-medium rounded-full">{{ $listing->horse->breed?->breed_name ?? 'Unknown' }}</span>
                                    <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-medium rounded-full">{{ ucfirst($listing->horse->sex) }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">{{ $listing->horse->registered_name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ $listing->horse->stable?->stable_name ?? 'Unknown Stable' }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mb-3 line-clamp-2">{{ Str::limit($listing->horse->description, 80) }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-emerald-600 dark:text-emerald-400">¥{{ number_format($listing->list_price) }}</span>
                                    <span class="inline-flex items-center text-sm text-green-600 dark:text-green-400 font-medium">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5"></span>
                                        On Sale
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $listings->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4">🐴</div>
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">No horses found</h3>
                <p class="text-gray-500 dark:text-gray-400">Try adjusting your search or filters.</p>
            </div>
        @endif
    </div>
</x-layouts.shop>
