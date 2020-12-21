<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\CorredorRequest;
use App\Http\Validators\CorredorValidator;
use App\Repository\CorredorRepository;
use Illuminate\Http\Request;

/**
 * Controlador que concentra os endpoints dos serviço de corredor
 * 
 * @author Eduardo Praxedes Heinske <praxeduardo@gmail.com>
 */
class CorredorController extends Controller
{
    /**
     * Repository de corredor
     *
     * @var CorredorRepository
     */
    protected $repository;

    /**
     * Validator de corredor
     *
     * @var CorredorValidator
     */
    protected $validator;

    /**
     * Construtor para injeção das dependências
     *
     * @param CorredorRepository $repository
     * @param CorredorValidator $validator
     */
    public function __construct(CorredorRepository $repository, CorredorValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Cadastra um corredor
     *
     * @param CorredorRequest $request
     * @return Response
     */
    public function cadastrar(CorredorRequest $request)
    {
        // Executa as validações negociais
        $validaton = $this->validator->cadastrarValidation($request->toArray());
        if(!$validaton['success']){
            return ResponseHelper::responseError([], $validaton['msg']);
        }

        // Cadastra o corredor
        try{
            $result = $this->repository->cadastrar($request->toArray());

            if($result){
                return ResponseHelper::responseSuccess(['id' => $result->id], "Corredor cadastrado com sucesso!");
            }else{
                return ResponseHelper::responseError([], "Falha ao cadastrar corredor!");
            }
        }catch(\Exception $ex){
            return ResponseHelper::responseError([], "Falha ao cadastrar corredor!");
        }
    }
}
