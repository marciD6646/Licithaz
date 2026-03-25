<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreBidRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => [
                'required',
                'integer',
                'min:' . $this->minimumBidAmount(),
                function ($attribute, $value, $fail) {
                    $product = $this->product();
                    if ($product && !$product->isBiddingOpen()) {
                        $fail('Bidding is closed for this product.');
                    }
                },
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'amount.min' => 'Your bid must be at least ' . number_format($this->minimumBidAmount()) . ' Ft.',
        ];
    }

    private function minimumBidAmount(): int
    {
        $product = $this->product();

        if ($product === null) {
            return 1000;
        }

        return $product->minimumNextBidAmount();
    }

    private function product(): ?Product
    {
        $product = $this->route('product');

        return $product instanceof Product ? $product : null;
    }
}
