<x-layouts.admin title="Order #{{ $order->id }}">
    <div class="max-w-4xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Order Details --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Details</h2>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Order ID</dt>
                        <dd class="font-medium text-gray-900 dark:text-white">#{{ $order->id }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Customer</dt>
                        <dd class="font-medium text-gray-900 dark:text-white">{{ $order->user->name }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Email</dt>
                        <dd class="font-medium text-gray-900 dark:text-white">{{ $order->user->email }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Horse</dt>
                        <dd class="font-medium text-gray-900 dark:text-white">{{ $order->listing->horse->registered_name }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Breed</dt>
                        <dd class="font-medium text-gray-900 dark:text-white">{{ $order->listing->horse->breed?->breed_name ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Amount</dt>
                        <dd class="font-bold text-emerald-600 dark:text-emerald-400">¥{{ number_format($order->total_amount) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Date</dt>
                        <dd class="font-medium text-gray-900 dark:text-white">{{ $order->datetime->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>

                {{-- Update Status --}}
                <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="flex items-end gap-3">
                        @csrf @method('PUT')
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Order Status</label>
                            <select name="status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500 text-sm">
                                @foreach(['pending', 'confirmed', 'completed', 'cancelled'] as $s)
                                    <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition text-sm font-medium">Update</button>
                    </form>
                </div>
            </div>

            {{-- Payment Details --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment Details</h2>
                @if($order->payment)
                    <dl class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-500 dark:text-gray-400">Payment ID</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">#{{ $order->payment->id }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 dark:text-gray-400">Method</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">{{ ucwords(str_replace('_', ' ', $order->payment->method)) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 dark:text-gray-400">Amount</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">¥{{ number_format($order->payment->amount) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 dark:text-gray-400">Status</dt>
                            <dd>
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $order->payment->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($order->payment->status) }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 dark:text-gray-400">Paid At</dt>
                            <dd class="font-medium text-gray-900 dark:text-white">{{ $order->payment->paid_at?->format('M d, Y H:i') ?? 'Not paid' }}</dd>
                        </div>
                    </dl>
                @else
                    <p class="text-gray-500 dark:text-gray-400">No payment record found.</p>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.orders.index') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline text-sm font-medium">← Back to Orders</a>
        </div>
    </div>
</x-layouts.admin>
