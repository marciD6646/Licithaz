<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::query()
            ->with([
                'user:id,name,email',
                'product:id,name',
            ])
            ->orderByDesc('id')
            ->get([
                'id',
                'user_id',
                'product_id',
                'amount',
                'is_paid',
                'created_at',
            ]);

        return response()->json([
            'payments' => $payments,
        ]);
    }
}
