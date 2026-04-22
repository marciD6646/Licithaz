<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class CloseAuctions extends Command
{
    protected $signature = 'auctions:close';

    protected $description = 'Resolve finished auctions (Option A - no persistence)';

    public function handle(): int
    {
        $products = Product::where('bid_end_date', '<=', now())->get();

        if ($products->isEmpty()) {
            $this->info('No finished auctions found.');
            return 0;
        }

        foreach ($products as $product) {

            $winningBid = $product->bids()
                ->orderByDesc('amount')
                ->first();

            if (!$winningBid) {
                $this->warn("No bids for: {$product->name}");
                continue;
            }

            $winner = $winningBid->user;

            $this->info("Auction finished: {$product->name}");
            $this->info("Winner: {$winner->name}");
            $this->info("Winning bid: " . number_format($winningBid->amount) . " Ft");
            $this->line('----------------------');
        }

        return 0;
    }
}