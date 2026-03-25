<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function show(): View
    {
        $user = Auth::user()->load([
            'bids' => function ($query) {
                $query->latest()->with('product');
            },
        ]);

        return view('profile', ['user' => $user]);
    }

}