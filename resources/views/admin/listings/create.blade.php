<x-layouts.admin title="Create Listing">
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.listings.store') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Horse *</label>
                <select name="horse_id" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500">
                    <option value="">-- Select Horse --</option>
                    @foreach($horses as $horse)
                        <option value="{{ $horse->id }}" {{ old('horse_id') == $horse->id ? 'selected' : '' }}>{{ $horse->registered_name }}</option>
                    @endforeach
                </select>
                @error('horse_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                @if($horses->isEmpty())
                    <p class="text-amber-600 text-sm mt-1">No available horses without an active listing. <a href="{{ route('admin.horses.create') }}" class="underline">Create a horse first</a>.</p>
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Price (¥) *</label>
                <input type="number" name="list_price" value="{{ old('list_price') }}" required min="0" step="0.01"
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500">
                @error('list_price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status *</label>
                <select name="status" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500">
                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">Create Listing</button>
                <a href="{{ route('admin.listings.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
