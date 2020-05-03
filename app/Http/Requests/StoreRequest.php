<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required|min:10',
            'phone' => 'required',
            'logo' => 'image'
        ];
    }

    public function messages(){

        return [
            'min' => 'O campo deve ter no mínimo :min caracteres',
            'required' => 'O campo é obrigatório',
            'image' => 'O arquivo não é uma imagem válida'
        ];

    }
}
