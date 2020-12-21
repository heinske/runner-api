<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ProvaRequest;
use App\Http\Validators\ProvaValidator;
use App\Repository\ProvaRepository;
use Illuminate\Http\Request;

/**
 * Controlador que concentra os endpoints dos serviço de Prova
 * 
 * @author Eduardo Praxedes Heinske <praxeduardo@gmail.com>
 */
class ProvaController extends Controller
{
    /**
     * Repository de Prova
     *
     * @var ProvaRepository
     */
    protected $repository;

    /**
     * Validator de Prova
     *
     * @var ProvaValidator
     */
    protected $validator;

    /**
     * Construtor para injeção das dependências
     *
     * @param ProvaRepository $repository
     * @param ProvaValidator $validator
     */
    public function __construct(ProvaRepository $repository, ProvaValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

     /**
     * Cadastra uma prova
     *
     * @param ProvaRequest $request
     * @return Response
     */
    public function cadastrar(ProvaRequest $request)
    { 
        // Executa as validações negociais
        $validaton = $this->validator->cadastrarValidation($request->toArray());
        if(!$validaton['success']){
            return ResponseHelper::responseError([], $validaton['msg']);
        }

        // Cadastra a prova
        try{
            $result = $this->repository->cadastrar($request->toArray());
            if($result){
                return ResponseHelper::responseSuccess(['id' => $result->id], "Prova cadastrada com sucesso!");
            }else{
                return ResponseHelper::responseError([], "Falha ao cadastrar prova!");
            }
        }catch(\Exception $ex){
            return ResponseHelper::responseError([], "Falha ao cadastrar prova!");
        }
    }
}
