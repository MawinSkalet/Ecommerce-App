<x-layouts.admin title="Manage Listings">
    <div class="flex items-center justify-between mb-6">
        <p class="text-gray-500 dark:text-gray-400">{{ $listings->total() }} listings total</p>
        <a href="{{ route('admin.listings.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium text-sm">+ Create Listing</a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Horse</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($listings as $listing)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $listing->id }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-white">{{ $listing->horse->registered_name }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-white">¥{{ number_format($listing->list_price) }}</td>
                            <td class="px-4 py-3">
                                @php $lc = ['active' => 'bg-green-100 text-green-800', 'sold' => 'bg-red-100 text-red-800', 'closed' => 'bg-gray-100 text-gray-800']; @endphp
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $lc[$listing->status] ?? 'bg-gray-100' }}">{{ ucfirst($listing->status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $listing->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.listings.edit', $listing) }}" class="text-emerald-600 hover:text-emerald-800 text-sm font-medium">Edit</a>
                                    <form method="POST" action="{{ route('admin.listings.destroy', $listing) }}" onsubmit="return confirm('Delete this listing?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">{{ $listings->links() }}</div>
</x-layouts.admin>
