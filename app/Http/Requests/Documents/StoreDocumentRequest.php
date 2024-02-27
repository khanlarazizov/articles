<?php

namespace App\Http\Requests\Documents;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'document_type' => 'required',
            'number' => 'required|integer',
            'date' => 'required',
            'other_side_name' => 'required',
//            'contract_id' => 'required',
            'currency' => 'required',
            'price' => 'required',
            'tag' => 'required',
            'file' => 'required|mimes:pdf'
        ];
    }
}
