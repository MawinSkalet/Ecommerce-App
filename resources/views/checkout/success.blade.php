<x-layouts.shop title="Order Successful">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-12">
            <div class="text-6xl mb-6">🎉</div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Purchase Successful!</h1>
            <p class="text-gray-500 dark:text-gray-400 mb-2">Congratulations! Your horse purchase has been confirmed.</p>
            <p class="text-gray-500 dark:text-gray-400 mb-8">The horse ownership has been transferred to your account.</p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('member.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl transition font-medium">
                    View My Account
                </a>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition font-medium">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</x-layouts.shop>
