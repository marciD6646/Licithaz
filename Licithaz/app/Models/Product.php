<?php

namespace App\Models;

use App\Models\Bid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'extended_description', 'image_url', 'starter_bid', 'bid_end_date', 'bid_start_date', 'category'];

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
}
