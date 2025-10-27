<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'trip_id' => ['required', 'exists:trips,id'],
            'airport_from_id' => ['required', 'exists:airports,id'],
            'airport_to_id' => ['required', 'exists:airports,id'],
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date', 'after:date_from'],
            'price' => ['required', 'numeric'],
            'people' => ['required', 'numeric', 'gt:0'],
            'url' => ['nullable', 'string'],
            'trip_type' => ['required', 'string', 'in:round-trip,one-way'],
            'airport_from_id_return' => ['nullable', 'exists:airports,id'],
            'airport_to_id_return' => ['nullable', 'exists:airports,id'],
            'date_from_return' => ['nullable', 'date'],
            'date_to_return' => ['nullable', 'date', 'after:date_from'],
        ];
    }
}
