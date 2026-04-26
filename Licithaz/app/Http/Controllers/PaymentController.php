<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Payment;
use App\Models\Product;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Show the payment form for the winning product.
     */
    public function checkout(Product $product): View
    {
        $this->ensureWinnerCanPay($product);
        $amount = $this->winningBidOrAbort($product)->amount;

        return view('payment', compact('product', 'amount'));
    }

    /**
     * Process the payment.
     */
    public function pay(PaymentRequest $request, Product $product): RedirectResponse
    {
        $this->ensureWinnerCanPay($product);
        $winningBid = $this->winningBidOrAbort($product);

        $product->status = 'sold';
        $product->save();

        Payment::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'amount' => $winningBid->amount,
            'is_paid' => true,
        ]);

        $winner = auth()->user();
        $amount = number_format($winningBid->amount);
        Mail::raw(
            "Congratulations {$winner->name}! Your payment for \"{$product->name}\" of {$amount} Ft has been confirmed. You are now the proud owner of this item.",
            function ($mail) use ($winner, $product) {
                $mail->to($winner->email)
                    ->subject("Payment confirmed – {$product->name}");
            }
        );

        return redirect()
            ->route('products.show', $product)
            ->with('status', 'Payment successful. You now own the item!');
    }

    /**
     * List all payments for the authenticated user.
     */
    public function index(): View
    {
        $payments = Payment::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('payments.index', compact('payments'));
    }

    /**
     * Admin: list all payments across all users.
     */
    public function adminIndex(): View
    {
        $this->authorize('viewAny', Payment::class);

        $payments = Payment::with(['user', 'product'])
            ->latest()
            ->paginate(20);

        return view('payments.admin', compact('payments'));
    }

    private function ensureWinnerCanPay(Product $product): void
    {
        if (auth()->id() !== (int) $product->winner_id) {
            abort(403, 'You are not the winner of this auction.');
        }

        if ($product->status !== 'pending_payment') {
            abort(403, 'This auction is not ready for payment.');
        }
    }

    private function winningBidOrAbort(Product $product): Bid
    {
        $winningBid = $product->winningBid();

        if ($winningBid === null) {
            abort(409, 'This auction has no winning bid yet.');
        }

        return $winningBid;
    }
}
