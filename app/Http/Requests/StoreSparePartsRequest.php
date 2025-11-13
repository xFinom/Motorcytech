<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSparePartsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'service_order_id' => 'required|string|exists:service_orders,id',
            'quotes' => 'required|array',
            'quotes.*.name' => 'required|string',
            'quotes.*.price' => 'required|numeric',
            'quotes.*.quantity' => 'required|integer',
        ];
    }
}
