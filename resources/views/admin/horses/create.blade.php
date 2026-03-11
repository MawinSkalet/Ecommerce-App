<x-layouts.admin title="Add Horse">
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.horses.store') }}" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Registered Name *</label>
                <input type="text" name="registered_name" value="{{ old('registered_name') }}" required
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500 focus:border-emerald-500">
                @error('registered_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sex *</label>
                    <select name="sex" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500">
                        <option value="male" {{ old('sex') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('sex') === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Birth Date</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Breed</label>
                    <select name="breed_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500">
                        <option value="">-- None --</option>
                        @foreach($breeds as $breed)
                            <option value="{{ $breed->id }}" {{ old('breed_id') == $breed->id ? 'selected' : '' }}>{{ $breed->breed_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stable</label>
                    <select name="stable_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500">
                        <option value="">-- None --</option>
                        @foreach($stables as $stable)
                            <option value="{{ $stable->id }}" {{ old('stable_id') == $stable->id ? 'selected' : '' }}>{{ $stable->stable_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status *</label>
                <select name="status" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500">
                    <option value="available" {{ old('status', 'available') === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="sold" {{ old('status') === 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="retired" {{ old('status') === 'retired' ? 'selected' : '' }}>Retired</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Photo</label>
                <input type="file" name="photo" accept="image/jpeg,image/png,image/webp"
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500 text-sm file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 dark:file:bg-emerald-900 dark:file:text-emerald-300 file:font-medium file:cursor-pointer">
                @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500">{{ old('description') }}</textarea>
            </div>

            {{-- Uma Musume Attributes --}}
            <div class="border-t border-gray-200 dark:border-gray-700 pt-5">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1 flex items-center gap-2"> Attributes <span class="text-xs font-normal text-gray-500">(1 – 1200)</span></h3>
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                    @foreach(['stat_speed' => 'Speed', 'stat_stamina' => 'Stamina', 'stat_power' => 'Power', 'stat_guts' => 'Guts', 'stat_wisdom' => 'Wisdom'] as $field => $label)
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">{{ $label }}</label>
                            <input type="number" name="{{ $field }}" value="{{ old($field, 300) }}" min="1" max="1200" required
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500 text-center text-sm">
                            @error($field) <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">Create Horse</button>
                <a href="{{ route('admin.horses.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
