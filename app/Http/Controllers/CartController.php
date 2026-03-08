<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Listing;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->getOrCreateCart();
        $cart->load(['items.listing.horse.breed', 'items.listing.horse.stable']);

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Listing $listing)
    {
        if ($listing->status !== 'active') {
            return back()->with('error', 'This listing is no longer available.');
        }

        $cart = auth()->user()->getOrCreateCart();

        // Check if already in cart
        $exists = CartItem::where('cart_id', $cart->id)
            ->where('listing_id', $listing->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This horse is already in your cart.');
        }

        CartItem::create([
            'cart_id' => $cart->id,
            'listing_id' => $listing->id,
        ]);

        return back()->with('success', 'Horse added to cart!');
    }

    public function remove(CartItem $cartItem)
    {
        $cart = auth()->user()->getOrCreateCart();

        if ($cartItem->cart_id !== $cart->id) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Horse removed from cart.');
    }
}
