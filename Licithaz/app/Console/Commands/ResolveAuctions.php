<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class ResolveAuctions extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:resolve-auctions';

    /**
     * The console command description.
     */
    protected $description = 'Resolve finished auctions, notify winners, and clean up products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::where('bid_end_date', '<=', now())
            ->where('status', 'active')
            ->get();

        foreach ($products as $product) {

            $this->info("Processing: {$product->id} | Status: {$product->status}");

            if ($product->trashed()) {
                $this->warn("Skipped (trashed)");
                continue;
            }

            $winningBid = $product->bids()
                ->with('user')
                ->orderByDesc('amount')
                ->first();

            if (!$winningBid) {
                $this->warn("No bids → closing");

                $product->status = 'closed';
                $product->save();
                continue;
            }

            $this->info("Winner: {$winningBid->user->id}");

            $product->winner_id = $winningBid->user_id;
            $product->status = 'pending_payment';
            $product->save();

            $this->info("Set to pending_payment ✅");

            Mail::raw(
                "You won the auction for '{$product->name}'. Please proceed to payment.",
                function ($mail) use ($winningBid) {
                    $mail->to($winningBid->user->email)
                        ->subject('You won the auction!');
                }
            );
        }
        $this->info('Auction resolution completed successfully.');
    }
}