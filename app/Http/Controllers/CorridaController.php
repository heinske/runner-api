<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\CorridaCadastroRequest;
use App\Http\Requests\CorridaRequest;
use App\Http\Requests\CorridaResultadoRequest;
use App\Http\Validators\CorridaValidator;
use App\Repository\CorridaRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Controlador que concentra os endpoints dos serviço de corrida
 * 
 * @author Eduardo Praxedes Heinske <praxeduardo@gmail.com>
 */
class CorridaController extends Controller
{
    /**
     * Repository de Corrida
     *
     * @var CorridaRepository
     */
    protected $repository;

    /**
     * Validator de Corrida
     *
     * @var CorridaValidator
     */
    protected $validator;

    /**
     * Construtor para injeção das dependências
     *
     * @param CorridaRepository $repository
     * @param CorridaValidator $validator
     */
    public function __construct(CorridaRepository $repository, CorridaValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Cadastra uma corrida
     *
     * @param CorridaRequest $request
     * @return Response
     */
    public function cadastrar(CorridaCadastroRequest $request)
    {
        // Executa as validações negociais
        $validaton = $this->validator->cadastrarValidation($request->toArray());
        if(!$validaton['success']){
            return ResponseHelper::responseError([], $validaton['msg']);
        }

        // Cadastra a corrida
        try{
            $result = $this->repository->cadastrar($request->toArray());
            if($result){
                return ResponseHelper::responseSuccess(['id' => $result->id], "Corrida cadastrada com sucesso!");
            }else{
                return ResponseHelper::responseError([], "Falha ao cadastrar corrida!");
            }
        }catch(\Exception $ex){
            return ResponseHelper::responseError([], "Falha ao cadastrar corrida!");
        }
    }

    /**
     * Cadastro o resultado da corrida
     *
     * @param CorridaResultadoRequest $request
     * @return Response
     */
    public function cadastrarResultado(CorridaResultadoRequest $request)
    {
        // Executa as validações negociais
        $validaton = $this->validator->cadastrarResultadoValidation($request->toArray());
        if(!$validaton['success']){
            return ResponseHelper::responseError([], $validaton['msg']);
        }

        // Cadastra o resultado da corrida
        try{
            $result = $this->repository->atualizar($request->toArray());
            if($result){
                return ResponseHelper::responseSuccess(['id' => $result->id], "Resultado cadastrado com sucesso!");
            }else{
                return ResponseHelper::responseError([], "Falha ao cadastrar resultado da corrida!");
            }
        }catch(\Exception $ex){
            return ResponseHelper::responseError([], "Falha ao cadastrar resultado da corrida!");
        }
    }

    public function gerarRelatorioGeral(Request $request)
    {
        return ResponseHelper::responseSuccess($this->repository->gerarRelatorioGeral(), "Relatorio gerado com sucesso!");
    }

    
    public function gerarRelatorioIdade(Request $request)
    {
        return ResponseHelper::responseSuccess($this->repository->gerarRelatorioIdade(), "Relatorio gerado com sucesso!");
    }

    
}
