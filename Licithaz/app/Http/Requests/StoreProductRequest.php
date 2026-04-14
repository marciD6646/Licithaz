<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'extended_description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bid_start_date' => 'required|date',
            'bid_end_date' => 'required|date|after_or_equal:bid_start_date',
            'category' => 'required|in:Electronics,Books,Clothing,House,Sports,Vehicles,Jewelry',
            'starter_bid' => 'required|numeric|min:0',
        ];
    }
}
