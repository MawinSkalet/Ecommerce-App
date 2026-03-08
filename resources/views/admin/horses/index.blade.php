<x-layouts.admin title="Manage Horses">
    <div class="flex items-center justify-between mb-6">
        <p class="text-gray-500 dark:text-gray-400">{{ $horses->total() }} horses total</p>
        <a href="{{ route('admin.horses.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium text-sm">+ Add Horse</a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Horse</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Breed</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stable</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sex</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($horses as $horse)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $horse->id }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $horse->photo_url ?? 'https://placehold.co/40x40/e2e8f0/94a3b8?text=?' }}" class="w-10 h-10 rounded-lg object-cover" alt="">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $horse->registered_name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $horse->breed?->breed_name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $horse->stable?->stable_name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($horse->sex) }}</td>
                            <td class="px-4 py-3">
                                @php $sc = ['available' => 'bg-green-100 text-green-800', 'sold' => 'bg-red-100 text-red-800', 'retired' => 'bg-gray-100 text-gray-800']; @endphp
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $sc[$horse->status] ?? 'bg-gray-100' }}">{{ ucfirst($horse->status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $horse->owner?->name ?? 'Store' }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.horses.edit', $horse) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                                    <form method="POST" action="{{ route('admin.horses.destroy', $horse) }}" onsubmit="return confirm('Delete this horse?')">
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
    <div class="mt-6">{{ $horses->links() }}</div>
</x-layouts.admin>
