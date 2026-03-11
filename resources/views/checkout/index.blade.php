<x-layouts.shop title="Checkout">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Order Summary --}}
            <div class="lg:col-span-2 space-y-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Summary</h2>
                @foreach($cart->items as $item)
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700 flex-shrink-0 flex items-end justify-center">
                            <img src="{{ $item->listing->horse->photo_url ?? 'https://placehold.co/200x200/e2e8f0/94a3b8?text=No+Photo' }}"
                                 alt="{{ $item->listing->horse->registered_name }}"
                                 class="w-full h-full object-contain object-bottom">
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900 dark:text-white">{{ $item->listing->horse->registered_name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->listing->horse->breed?->breed_name }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400">¥{{ number_format($item->listing->list_price) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Payment --}}
            <div>
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment</h2>

                    <form method="POST" action="{{ route('checkout.process') }}">
                        @csrf
                        <div class="space-y-3 mb-6">
                            <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <input type="radio" name="payment_method" value="credit_card" checked class="text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">💳 Credit Card</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <input type="radio" name="payment_method" value="bank_transfer" class="text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">🏦 Bank Transfer</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <input type="radio" name="payment_method" value="promptpay" class="text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">📱 PromptPay</span>
                            </label>
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mb-4">
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400 mb-2">
                                <span>Items ({{ $cart->items->count() }})</span>
                                <span>¥{{ number_format($total) }}</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold text-gray-900 dark:text-white">
                                <span>Total</span>
                                <span>¥{{ number_format($total) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition shadow-sm">
                            Confirm Purchase
                        </button>
                    </form>

                    <a href="{{ route('cart.index') }}" class="block text-center text-sm text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 mt-3">
                        ← Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.shop>
