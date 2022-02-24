<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrUpdateExpenseRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'description' => 'required|max:255',
            'amount' => 'required|numeric|min:0',
            'period' => [
                'required',
                Rule::in(['monthly', 'annually'])
            ]
        ];
    }
}
