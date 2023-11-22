<?php

namespace App\Http\Requests\Contracts;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
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
            'folder_id'=>'required',
            'type' => 'required',
            'shopping' => 'required',
            'other_side_type' => 'required',
            'other_side_name' => 'required',
            'price' => 'required',
            'tag' => 'required',
            'currency' => 'required',
            'file' => 'required|mimes:pdf'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad daxil edin',
            'date.required' => 'Tarix daxil edin',
            'folder_id.required' => 'Qovluq daxil edin',
            'type.required' => 'Tip daxil edin',
            'shopping.required' => 'nese daxil edin',
            'other_side_type.required' => 'Tip daxil edin',
            'other_side_name.required' => 'Təmsilçini daxil edin',
            'price.required' => 'Dəyər daxil edin',
            'tag.required' => 'Etiket daxil edin',
            'currency.required' => 'Ad daxil edin',
            'file.required' => 'Fayl daxil edin'
        ];
    }
}
