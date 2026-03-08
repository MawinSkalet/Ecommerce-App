<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Listing::with(['horse.breed', 'horse.stable'])
            ->active()
            ->inRandomOrder()
            ->take(3)
            ->get();

        $newest = Listing::with(['horse.breed', 'horse.stable'])
            ->active()
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featured', 'newest'));
    }
}
