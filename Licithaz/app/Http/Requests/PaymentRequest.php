<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $product = $this->route('product');

        return $this->user()->id === $product->winner_id
            && $product->status === 'pending_payment';
    }

    public function rules(): array
    {
        return [
            'card_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'card_number' => ['required', 'digits_between:13,19'],
            'expiry_date' => ['required'],
            'cvv' => ['required', 'digits_between:3,4'],
        ];
    }
}
