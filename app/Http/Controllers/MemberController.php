<?php

namespace App\Http\Controllers;

class MemberController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->load('horses.breed', 'horses.stable');

        $orders = $user->orders()
            ->with(['listing.horse', 'payment'])
            ->latest('datetime')
            ->get();

        return view('member.index', compact('user', 'orders'));
    }
}
