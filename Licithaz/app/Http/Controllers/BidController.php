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
        if (!$product->isBiddingOpen() || $product->status !== 'active') {
            return redirect()
                ->route('products.show', $product)
                ->withErrors(['amount' => 'Bidding is closed for this product.']);
        }

        $oldHighestBid = $product->bids()
            ->with('user')
            ->orderByDesc('amount')
            ->orderByDesc('id')
            ->first();

        $bid = $product->bids()->create([
            'user_id' => $request->user()->id,
            'amount' => $request->validated('amount'),
        ]);

        $product->userOutBid($bid, $oldHighestBid);

        return redirect()
            ->route('products.show', $product)
            ->with('status', 'Bid placed successfully: ' . number_format($bid->amount) . ' Ft.');
    }
}
