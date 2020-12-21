<?php

namespace App\Http\Validators;

use App\Repository\CorredorRepository;
use App\Repository\CorridaRepository;
use App\Repository\ProvaRepository;

/**
 * Concentra as validações negociais dos serviços de corrida
 */
class CorridaValidator
{
    
    /**
     * Repository de Corrida
     *
     * @var CorridaRepository
     */
    protected $repository;

    /**
     * Repository de Corredor
     *
     * @var CorredorRepository
     */
    protected $corredorRepository;

    /**
     * Repository de Prova
     *
     * @var ProvaRepository
     */
    protected $provaRepository;

     /**
     * Construtor para injeção das dependências
      *
      * @param CorridaRepository $repository
      * @param CorredorRepository $corredorRepository
      * @param ProvaRepository $provaRepository
      */
    public function __construct(CorridaRepository $repository, CorredorRepository $corredorRepository, ProvaRepository $provaRepository)
    {
        $this->repository = $repository;
        $this->corredorRepository = $corredorRepository;
        $this->provaRepository = $provaRepository;
    }

    /**
     * Realiza as validações negociais do cadastro de corrida
     *
     * @param array $data
     * @return array
     */
    public function cadastrarValidation(array $data)
    {

        // Verifica a existência da prova
        if(!$this->provaRepository->find($data['prova_id'])){
            return ['success' => false, 'msg' => 'Prova inexistente!'];
        }

        // Verifica a existência do corredor
        if(!$this->corredorRepository->find($data['corredor_id'])){
            return ['success' => false, 'msg' => 'Corredor inexistente!'];
        }

        // Verifica se o corredor não foi cadastrado nessa mesma prova
        if($this->repository->busca($data)->count() > 0){
            return ['success' => false, 'msg' => 'Esse corredor já foi cadastrado nessa prova!'];
        }
        
        return ['success' => true, 'msg' => ''];
    }

    /**
     * Realiza as validações negociais do cadastro de resultados da corrida
     *
     * @param array $data
     * @return array
     */
    public function cadastrarResultadoValidation(array $data)
    {
        // Verifica a existência da corrida
        if(!$this->repository->find($data['id'])){
            return ['success' => false, 'msg' => 'Corrida inexistente!'];
        }

        return ['success' => true, 'msg' => ''];
    }
}
