<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\Listing;

class ProductController extends Controller
{
    public function index()
    {
        $query = Listing::with(['horse.breed', 'horse.stable'])->active();

        if (request('breed')) {
            $query->whereHas('horse', fn ($q) => $q->where('breed_id', request('breed')));
        }

        if (request('search')) {
            $search = request('search');
            $query->whereHas('horse', fn ($q) => $q->where('registered_name', 'like', "%{$search}%"));
        }

        if (request('sort') === 'price_asc') {
            $query->orderBy('list_price', 'asc');
        } elseif (request('sort') === 'price_desc') {
            $query->orderBy('list_price', 'desc');
        } else {
            $query->latest();
        }

        $listings = $query->paginate(12);
        $breeds = Breed::orderBy('breed_name')->get();

        return view('products.index', compact('listings', 'breeds'));
    }

    public function show(Listing $listing)
    {
        $listing->load(['horse.breed', 'horse.stable', 'horse.owner']);
        return view('products.show', compact('listing'));
    }
}
