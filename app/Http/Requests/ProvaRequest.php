<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProvaRequest extends FormRequest
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
            'data' => 'required|date',
            'tipo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'O campo data é obrigatório!',
            'data.date' => 'O campo data deve ser uma data no formato yyyy-mm-dd!',
            'tipo.required' => 'O campo tipo é obrigatório!'
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
        throw new HttpResponseException(ResponseHelper::responseError($validator->errors()->all(), "Falha ao salvar prova!"));
    }

}
