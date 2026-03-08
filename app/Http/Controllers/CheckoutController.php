<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->getOrCreateCart();
        $cart->load(['items.listing.horse.breed', 'items.listing.horse.stable']);

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cart->totalPrice();

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:credit_card,bank_transfer,promptpay',
        ]);

        $cart = auth()->user()->getOrCreateCart();
        $cart->load('items.listing.horse');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            $orders = [];

            foreach ($cart->items as $item) {
                $listing = $item->listing;

                // Check listing is still active
                if ($listing->status !== 'active') {
                    DB::rollBack();
                    return redirect()->route('cart.index')
                        ->with('error', "Sorry, \"{$listing->horse->registered_name}\" is no longer available.");
                }

                // Create order
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'listing_id' => $listing->id,
                    'total_amount' => $listing->list_price,
                    'status' => 'confirmed',
                    'datetime' => now(),
                ]);

                // Create payment
                Payment::create([
                    'order_id' => $order->id,
                    'method' => $request->payment_method,
                    'amount' => $listing->list_price,
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);

                // Mark listing as sold
                $listing->update(['status' => 'sold']);

                // Update horse ownership & status
                $listing->horse->update([
                    'user_id' => auth()->id(),
                    'status' => 'sold',
                ]);

                $orders[] = $order;
            }

            // Clear cart items
            $cart->items()->delete();

            DB::commit();

            return redirect()->route('checkout.success')
                ->with('orders', collect($orders)->pluck('id')->toArray());

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')
                ->with('error', 'An error occurred during checkout. Please try again.');
        }
    }

    public function success()
    {
        return view('checkout.success');
    }
}
