<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AuctionResolutionController extends Controller
{
    public function resolveIfEnded(Product $product): void
    {
        if (!$product->isAuctionEnded() || $product->status !== 'active') {
            return;
        }

        $winningBid = $product->winningBid();

        if ($winningBid) {
            $product->winner_id = $winningBid->user_id;
            $product->status = 'pending_payment';
            $product->notifyWinner($winningBid);
        } else {
            $product->status = 'closed';
        }

        $product->save();
    }

}
