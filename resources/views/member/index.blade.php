<x-layouts.shop title="My Account">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">My Account</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Profile Info --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                        <span class="inline-block px-2.5 py-0.5 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 text-xs font-medium rounded-full mt-1">{{ ucfirst($user->role) }}</span>
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Email</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $user->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Phone</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $user->phone ?? 'Not set' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Member Since</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $user->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('profile.edit') }}" class="block w-full text-center py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Owned Horses --}}
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">My Horses ({{ $user->horses->count() }})</h2>
                    @if($user->horses->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($user->horses as $horse)
                                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden flex">
                                    <div class="w-24 h-24 flex-shrink-0 bg-gray-100 dark:bg-gray-700">
                                        <img src="{{ $horse->photo_url ?? 'https://placehold.co/200x200/e2e8f0/94a3b8?text=No+Photo' }}"
                                             alt="{{ $horse->registered_name }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-3 flex flex-col justify-center">
                                        <h3 class="font-bold text-gray-900 dark:text-white text-sm">{{ $horse->registered_name }}</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $horse->breed?->breed_name ?? 'Unknown' }} &bull; {{ ucfirst($horse->sex) }}</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $horse->stable?->stable_name ?? 'Unknown Stable' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-8 text-center border border-gray-200 dark:border-gray-700">
                            <p class="text-gray-500 dark:text-gray-400">You don't own any horses yet.</p>
                            <a href="{{ route('products.index') }}" class="inline-block mt-3 text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Browse Available Horses →</a>
                        </div>
                    @endif
                </div>

                {{-- Order History --}}
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Order History ({{ $orders->count() }})</h2>
                    @if($orders->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-900/50">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Order #</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Horse</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Amount</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Status</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($orders as $order)
                                            <tr>
                                                <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-white">#{{ $order->id }}</td>
                                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $order->listing->horse->registered_name ?? 'Unknown' }}</td>
                                                <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-white">¥{{ number_format($order->total_amount) }}</td>
                                                <td class="px-4 py-3">
                                                    @php
                                                        $statusColors = [
                                                            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300',
                                                            'confirmed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300',
                                                            'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300',
                                                            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300',
                                                        ];
                                                    @endphp
                                                    <span class="inline-block px-2 py-0.5 text-xs font-medium rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $order->datetime->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-8 text-center border border-gray-200 dark:border-gray-700">
                            <p class="text-gray-500 dark:text-gray-400">No orders yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.shop>
