<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
        $rules = [
            'categoria' => 'required|exists:categorias,id',
            'nome' => 'required|max:64',
            'ativo' => 'required|boolean',
            'descricao' => 'max:1000',
        ];

        if(is_object($this->file('imagem'))){
            $rules['imagem'] = 'mimes:jpeg,png';
        }

        return $rules;
    }
}
