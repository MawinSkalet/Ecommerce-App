<x-layouts.admin title="Edit Listing #{{ $listing->id }}">
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.listings.update', $listing) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Horse</label>
                <input type="text" value="{{ $listing->horse->registered_name }}" disabled
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white bg-gray-50 dark:bg-gray-900 cursor-not-allowed">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Price (¥) *</label>
                <input type="number" name="list_price" value="{{ old('list_price', $listing->list_price) }}" required min="0" step="0.01"
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                @error('list_price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status *</label>
                <select name="status" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                    <option value="active" {{ old('status', $listing->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="sold" {{ old('status', $listing->status) === 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="closed" {{ old('status', $listing->status) === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">Update Listing</button>
                <a href="{{ route('admin.listings.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
