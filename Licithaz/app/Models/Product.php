<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'extended_description',
        'image_url',
        'starter_bid',
        'bid_end_date',
        'bid_start_date',
        'category'
    ];

    protected function casts(): array
    {
        return [
            'bid_start_date' => 'datetime',
            'bid_end_date' => 'datetime',
        ];
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class, 'auction_item_id');
    }

    public function currentHighestBidAmount(): int
    {
        return (int) ($this->bids()->max('amount') ?? $this->starter_bid);
    }

    public function minimumNextBidAmount(): int
    {
        $highestBid = $this->bids()->max('amount');

        return $highestBid === null
            ? (int) $this->starter_bid
            : (int) $highestBid + 1000;
    }

    public function isBiddingOpen(): bool
    {
        $now = now();

        return $now->greaterThanOrEqualTo($this->bid_start_date)
            && $now->lessThanOrEqualTo($this->bid_end_date);
    }

    public function userOutBid(Bid $newBid, ?Bid $oldHighestBid = null): void
    {
        if ($oldHighestBid === null) {
            return;
        }

        if ((int) $newBid->amount <= (int) $oldHighestBid->amount) {
            return;
        }

        if ((int) $oldHighestBid->user_id === (int) $newBid->user_id) {
            return;
        }

        $outbidUser = $oldHighestBid->user;

        if ($outbidUser === null || empty($outbidUser->email)) {
            return;
        }

        $amount = number_format((int) $newBid->amount);
        $message = "You have been outbid on {$this->name}. New highest bid: {$amount} Ft. "
            . route('products.show', $this);

        Mail::raw($message, function ($mail) use ($outbidUser) {
            $mail->to($outbidUser->email)
                ->subject('You have been outbid');
        });
    }

    public function notifyWinner(Bid $winningBid): void
    {
        $winner = $winningBid->user ?? $winningBid->user()->first();

        if ($winner === null || empty($winner->email)) {
            return;
        }

        $amount = number_format((int) $winningBid->amount);
        $paymentUrl = route('products.checkout', $this);

        Mail::raw(
            "Congratulations! You won the auction for '{$this->name}' with {$amount} Ft. Please complete payment here: {$paymentUrl}",
            function ($mail) use ($winner) {
                $mail->to($winner->email)
                    ->subject('You won the auction!');
            }
        );
    }

    public function winningBid(): ?Bid
    {
        return $this->bids()
            ->orderByDesc('amount')
            ->first();
    }

    public function isAuctionEnded(): bool
    {
        return now()->greaterThan($this->bid_end_date);
    }
}
