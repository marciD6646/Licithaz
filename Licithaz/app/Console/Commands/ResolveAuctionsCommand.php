<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class ResolveAuctionsCommand extends Command
{
    protected $signature = 'auctions:resolve';

    protected $description = 'Resolve ended auctions and notify winners by email';

    public function handle(): int
    {
        $products = Product::where('bid_end_date', '<=', now())
            ->where('status', 'active')
            ->get();

        foreach ($products as $product) {
            $winningBid = $product->winningBid();

            if ($winningBid) {
                $product->winner_id = $winningBid->user_id;
                $product->status = 'pending_payment';
                $product->save();

                $product->notifyWinner($winningBid);
            } else {
                $product->status = 'closed';
                $product->save();
            }
        }

        return self::SUCCESS;
    }
}
