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

            if ($product->trashed()) {
                continue;
            }

            $winner = $product->winner();

            if (!$winner) {
                $product->status = 'ended';
                $product->save();
                continue;
            }

            $product->winner_id = $winner->id;
            $product->status = 'pending_payment';
            $product->save();

            Mail::raw(
                "You won the auction for '{$product->name}'. Please proceed to payment.",
                function ($mail) use ($winner) {
                    $mail->to($winner->email)
                        ->subject('You won the auction!');
                }
            );
        }

        $this->info('Auction resolution completed successfully.');
    }
}