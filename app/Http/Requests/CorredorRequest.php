<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CorredorRequest extends FormRequest
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
            'nome' => 'required|max:255',
            'cpf' => 'required|size:11',
            'data_nascimento' => 'required|date'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório!',
            'nome.max'  => 'O campo nome deve ter no máximo 255 caracteres!',
            'cpf.required' => 'O campo cpf é obrigatório!',
            'cpf.size' => 'O campo cpf deve ter 11 caracteres!',
            'data_nascimento.required' => 'O campo data de nascimento é obrigatório!',
            'data_nascimento.date' => 'O campo data de nascimento deve ser uma data no formato yyyy-mm-dd!'
        ];
    }

    /**
     * Formatação da resposta
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseHelper::responseError($validator->errors()->all(), "Falha ao salvar corredor!"));
    }

}
