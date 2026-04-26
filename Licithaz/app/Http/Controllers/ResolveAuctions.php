<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ResolveAuctions extends Controller
{
    public function handle(AuctionResolutionController $auctionResolutionController): JsonResponse
    {
        /** @var \Illuminate\Database\Eloquent\Collection<int, Product> $products */
        $products = Product::where('bid_end_date', '<=', now())
            ->where('status', 'active')
            ->get();

        $closedCount = 0;
        $pendingPaymentCount = 0;
        $skippedCount = 0;

        foreach ($products as $product) {
            /** @var Product $product */
            if ($product->trashed()) {
                $skippedCount++;
                continue;
            }

            $statusBefore = $product->status;

            $auctionResolutionController->resolveIfEnded($product);

            if ($statusBefore !== $product->status) {
                if ($product->status === 'closed') {
                    $closedCount++;
                } elseif ($product->status === 'pending_payment' && $product->winner_id !== null) {
                    $pendingPaymentCount++;
                }
            }
        }

        return response()->json([
            'message' => 'Auction resolution completed successfully.',
            'closed' => $closedCount,
            'pending_payment' => $pendingPaymentCount,
            'skipped' => $skippedCount,
            'checked' => $products->count(),
        ]);
    }
}
