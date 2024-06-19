<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;

class RaceRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'active' => 'required|boolean',
            
            'lote_1_price' => 'required|decimal:2',
            'lote_1_date' => 'required|date',

            'lote_2_price' => 'decimal:2',
            'lote_2_date' => 'date',

            'lote_3_price' => 'decimal:2',
            'lote_3_date' => 'date',

            'lote_4_price' => 'decimal:2',
            'lote_4_date' => 'date',

            'lote_5_price' => 'decimal:2',
            'lote_5_date' => 'date',

            'image' => 'required|string',
            'slug' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'lote_1_price.required' => 'O valor do primeiro lote é obrigatório.',
            'lote_1_price.decimal' => 'O campo valor do primeiro lote deve ser decimal.',
            'lote_1_date.required' => 'O campo data do primeiro lote é obrigatório.',


            'lote_2_price.decimal' => 'O campo valor do segundo lote deve ser decimal.',
            // 'lote_3_price.decimal' => 'O campo valor do primeiro lote deve ser decimal.',

            // 'lote_4_price.decimal' => 'O campo valor do primeiro lote deve ser decimal.',

            // 'lote_5_price.decimal' => 'O campo valor do primeiro lote deve ser decimal.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
