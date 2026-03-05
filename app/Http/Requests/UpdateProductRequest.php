<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        //TODO: ONLY ADMIN
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod("put")) {
            return [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'extended_description' => 'required|string',
                'image_url' => 'required|url',
                'bid_start_date' => 'required|date',
                'bid_end_date' => 'required|date|after_or_equal:bid_start_date',
                'category' => 'required|in:Electronics,Books,Clothing,House,Sports,Vehicles,Jewelry',
                'starter_bid' => 'required|numeric|min:0',
            ];
        }
        ;

        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'extended_description' => 'sometimes|string',
            'image_url' => 'sometimes|url',
            'bid_start_date' => 'sometimes|date',
            'bid_end_date' => 'sometimes|date|after_or_equal:bid_start_date',
            'category' => 'sometimes|in:Electronics,Books,Clothing,House,Sports,Vehicles,Jewelry',
            'starter_bid' => 'sometimes|numeric|min:0',
        ];
    }
}
