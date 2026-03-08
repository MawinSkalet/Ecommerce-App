<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Horse;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::with('horse.breed')
            ->latest()
            ->paginate(15);

        return view('admin.listings.index', compact('listings'));
    }

    public function create()
    {
        // Only horses that don't have an active listing
        $horses = Horse::where('status', 'available')
            ->whereDoesntHave('listings', fn ($q) => $q->where('status', 'active'))
            ->orderBy('registered_name')
            ->get();

        return view('admin.listings.create', compact('horses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'horse_id' => 'required|exists:horses,id',
            'list_price' => 'required|numeric|min:0',
            'status' => 'required|in:active,closed',
        ]);

        Listing::create($validated);

        return redirect()->route('admin.listings.index')
            ->with('success', 'Listing created successfully.');
    }

    public function edit(Listing $listing)
    {
        $listing->load('horse');

        return view('admin.listings.edit', compact('listing'));
    }

    public function update(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'list_price' => 'required|numeric|min:0',
            'status' => 'required|in:active,sold,closed',
        ]);

        $listing->update($validated);

        return redirect()->route('admin.listings.index')
            ->with('success', 'Listing updated successfully.');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->route('admin.listings.index')
            ->with('success', 'Listing deleted successfully.');
    }
}
