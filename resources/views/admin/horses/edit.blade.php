<x-layouts.admin title="Edit Horse: {{ $horse->registered_name }}">
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.horses.update', $horse) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Registered Name *</label>
                <input type="text" name="registered_name" value="{{ old('registered_name', $horse->registered_name) }}" required
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                @error('registered_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sex *</label>
                    <select name="sex" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                        <option value="male" {{ old('sex', $horse->sex) === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('sex', $horse->sex) === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Birth Date</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $horse->birth_date?->format('Y-m-d')) }}"
                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Breed</label>
                    <select name="breed_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                        <option value="">-- None --</option>
                        @foreach($breeds as $breed)
                            <option value="{{ $breed->id }}" {{ old('breed_id', $horse->breed_id) == $breed->id ? 'selected' : '' }}>{{ $breed->breed_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stable</label>
                    <select name="stable_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                        <option value="">-- None --</option>
                        @foreach($stables as $stable)
                            <option value="{{ $stable->id }}" {{ old('stable_id', $horse->stable_id) == $stable->id ? 'selected' : '' }}>{{ $stable->stable_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status *</label>
                <select name="status" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                    <option value="available" {{ old('status', $horse->status) === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="sold" {{ old('status', $horse->status) === 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="retired" {{ old('status', $horse->status) === 'retired' ? 'selected' : '' }}>Retired</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Photo URL</label>
                <input type="url" name="photo_url" value="{{ old('photo_url', $horse->photo_url) }}" placeholder="https://..."
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                @if($horse->photo_url)
                    <img src="{{ $horse->photo_url }}" class="mt-2 w-32 h-24 object-cover rounded-lg" alt="">
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">{{ old('description', $horse->description) }}</textarea>
            </div>

            {{-- Uma Musume Attributes --}}
            <div class="border-t border-gray-200 dark:border-gray-700 pt-5">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1 flex items-center gap-2">⚡ Attributes <span class="text-xs font-normal text-gray-500">(1 – 1200)</span></h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Uma Musume-style racing stats for this horse</p>
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                    @foreach(['stat_speed' => 'Speed', 'stat_stamina' => 'Stamina', 'stat_power' => 'Power', 'stat_guts' => 'Guts', 'stat_wisdom' => 'Wisdom'] as $field => $label)
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">{{ $label }}</label>
                            <input type="number" name="{{ $field }}" value="{{ old($field, $horse->$field) }}" min="1" max="1200" required
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 text-center text-sm">
                            @error($field) <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">Update Horse</button>
                <a href="{{ route('admin.horses.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
