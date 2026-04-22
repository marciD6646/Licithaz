<?php

namespace App\Models;

use App\Models\Bid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use App\Models\User;


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
            'bid_start_date' => 'date',
            'bid_end_date' => 'date',
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
        $today = now()->startOfDay();

        return $today->greaterThanOrEqualTo($this->bid_start_date)
            && $today->lessThanOrEqualTo($this->bid_end_date);
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
    public function winningBid(): ?Bid
    {
        return $this->bids()
            ->orderByDesc('amount')
            ->first();
    }

    public function winner(): ?User
    {
        return $this->winningBid()?->user;
    }

    public function isAuctionEnded(): bool
    {
        return now()->greaterThan($this->bid_end_date);
    }

    public function markAsPaid(): void
    {
        $this->delete();
    }
}
