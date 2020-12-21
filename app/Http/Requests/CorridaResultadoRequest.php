<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CorridaResultadoRequest extends FormRequest
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
            'id' => 'required',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_termino' => 'required|date_format:H:i:s'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'id.required' => 'O campo id é obrigatório!',
            'hora_inicio.required' => 'O campo hora início é obrigatório!',
            'hora_inicio.date_format' => 'O campo hora início deve estar no formato H:i:s',
            'hora_termino.required' => 'O campo hora término é obrigatório!',
            'hora_termino.date_format' => 'O campo hora término deve estar no formato H:i:s'
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
        throw new HttpResponseException(ResponseHelper::responseError($validator->errors()->all(), "Falha ao salvar palestrante!"));
    }

}
