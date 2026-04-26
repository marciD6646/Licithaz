<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bid;

class BidController extends Controller
{
    public function index()
    {
        $bids = Bid::orderBy('id', 'desc')->get();
        return response()->json($bids);
    }
    public function userBids($userId)
    {
        return Bid::where('user_id', $userId)->get();
    }
}