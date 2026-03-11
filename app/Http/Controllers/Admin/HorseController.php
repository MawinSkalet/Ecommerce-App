<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Models\Horse;
use App\Models\Stable;
use Illuminate\Http\Request;

class HorseController extends Controller
{
    public function index()
    {
        $horses = Horse::with(['breed', 'stable', 'owner', 'activeListing'])
            ->latest()
            ->paginate(15);

        return view('admin.horses.index', compact('horses'));
    }

    public function create()
    {
        $breeds = Breed::orderBy('breed_name')->get();
        $stables = Stable::orderBy('stable_name')->get();

        return view('admin.horses.create', compact('breeds', 'stables'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registered_name' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'description' => 'nullable|string',
            'status' => 'required|in:available,sold,retired',
            'photo_url' => 'nullable|string|max:500',
            'stat_speed' => 'required|integer|min:1|max:1200',
            'stat_stamina' => 'required|integer|min:1|max:1200',
            'stat_power' => 'required|integer|min:1|max:1200',
            'stat_guts' => 'required|integer|min:1|max:1200',
            'stat_wisdom' => 'required|integer|min:1|max:1200',
            'breed_id' => 'nullable|exists:breeds,id',
            'stable_id' => 'nullable|exists:stables,id',
        ]);

        Horse::create($validated);

        return redirect()->route('admin.horses.index')
            ->with('success', 'Horse created successfully.');
    }

    public function edit(Horse $horse)
    {
        $breeds = Breed::orderBy('breed_name')->get();
        $stables = Stable::orderBy('stable_name')->get();

        return view('admin.horses.edit', compact('horse', 'breeds', 'stables'));
    }

    public function update(Request $request, Horse $horse)
    {
        $validated = $request->validate([
            'registered_name' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'description' => 'nullable|string',
            'status' => 'required|in:available,sold,retired',
            'photo_url' => 'nullable|string|max:500',
            'stat_speed' => 'required|integer|min:1|max:1200',
            'stat_stamina' => 'required|integer|min:1|max:1200',
            'stat_power' => 'required|integer|min:1|max:1200',
            'stat_guts' => 'required|integer|min:1|max:1200',
            'stat_wisdom' => 'required|integer|min:1|max:1200',
            'breed_id' => 'nullable|exists:breeds,id',
            'stable_id' => 'nullable|exists:stables,id',
        ]);

        $horse->update($validated);

        return redirect()->route('admin.horses.index')
            ->with('success', 'Horse updated successfully.');
    }

    public function destroy(Horse $horse)
    {
        $horse->delete();

        return redirect()->route('admin.horses.index')
            ->with('success', 'Horse deleted successfully.');
    }
}
