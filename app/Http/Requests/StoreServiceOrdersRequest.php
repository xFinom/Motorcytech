<?php

namespace App\Http\Requests;

use App\Rules\RfcValid;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreServiceOrdersRequest extends FormRequest
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
            'client' => 'required',
            'client.name' => 'required|string|max:255',
            'client.email' => 'required|string|email|unique:users,email|max:255',
            'client.phone' => 'required|string|max:255',
            'client.address' => 'required|string|max:255',
            'client.rfc' => ['string', new RfcValid],
            'motorcycle' => 'required',
            'motorcycle.placa' => 'required|string|max:255',
            'motorcycle.serial_num' => 'required|string|max:255',
            'motorcycle.motor_num' => 'required|string|max:255',
            'motorcycle.brand_id' => 'required|integer|exists:brands,id',
            'motorcycle.type_id' => 'required|integer|exists:motorcycle_types,id',
            'motorcycle.year' => 'required|integer|digits:4',
            'service' => 'required',
            'service.service_id' => 'required|integer',
            'service.note' => 'string|nullable',
        ];
    }
}
