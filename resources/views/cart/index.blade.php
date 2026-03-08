<x-layouts.shop title="Shopping Cart">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Shopping Cart</h1>

        @if($cart->items->count() > 0)
            <div class="space-y-4 mb-8">
                @foreach($cart->items as $item)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
                        <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700 flex-shrink-0">
                            <img src="{{ $item->listing->horse->photo_url ?? 'https://placehold.co/200x200/e2e8f0/94a3b8?text=No+Photo' }}"
                                 alt="{{ $item->listing->horse->registered_name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-900 dark:text-white">{{ $item->listing->horse->registered_name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $item->listing->horse->breed?->breed_name ?? 'Unknown Breed' }} &bull;
                                {{ $item->listing->horse->stable?->stable_name ?? 'Unknown Stable' }}
                            </p>
                            <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400 mt-1">¥{{ number_format($item->listing->list_price) }}</p>
                        </div>
                        <form method="POST" action="{{ route('cart.remove', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition" title="Remove">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Total --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-lg text-gray-600 dark:text-gray-400">Total ({{ $cart->items->count() }} {{ Str::plural('item', $cart->items->count()) }})</span>
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">¥{{ number_format($cart->totalPrice()) }}</span>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('products.index') }}" class="flex-1 py-3 text-center border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition font-medium">
                        Continue Shopping
                    </a>
                    <a href="{{ route('checkout.index') }}" class="flex-1 py-3 text-center bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl transition font-bold shadow-sm">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4">🛒</div>
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Your cart is empty</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Start browsing our horse collection!</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-medium">
                    Browse Horses
                </a>
            </div>
        @endif
    </div>
</x-layouts.shop>
