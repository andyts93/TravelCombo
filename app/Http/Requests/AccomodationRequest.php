<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccomodationRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'addressLine' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'administrative_area' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string'],
            'region_code' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'price' => ['required', 'numeric', 'gt:0'],
            'url' => ['nullable', 'string'],
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date', 'after:date_from'],
            'people' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
