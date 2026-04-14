<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBidRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class BidController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBidRequest $request, Product $product): RedirectResponse
    {
        $bid = $product->bids()->create([
            'user_id' => $request->user()->id,
            'amount' => $request->validated('amount'),
        ]);

        return redirect()
            ->route('products.show', $product)
            ->with('status', 'Bid placed successfully: ' . number_format($bid->amount) . ' Ft.');
    }
}
