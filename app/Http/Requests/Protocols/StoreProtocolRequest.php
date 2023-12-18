<?php

namespace App\Http\Requests\Protocols;

use Illuminate\Foundation\Http\FormRequest;

class StoreProtocolRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'date' => 'required',
            'other_side_name' => 'required',
            'contract_id' => 'required',
            'currency' => 'required',
            'price' => 'required',
            'tag' => 'required',
            'file' => 'required|mimes:pdf'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad daxil edin',
            'date.required' => 'Tarix daxil edin',
            'other_side_name.required' => 'Təmsilçini daxil edin',
            'contract_id.required' => 'Müqavilə daxil edin',
            'currency.required' => 'Valyuta daxil edin',
            'price.required' => 'Dəyər daxil edin',
            'tag.required' => 'Etiket daxil edin',
            'file.required' => 'Fayl daxil edin'
        ];
    }
}
