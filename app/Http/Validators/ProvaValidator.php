<?php

namespace App\Http\Validators;

use App\Model\Prova;
use App\Repository\ProvaRepository;

/**
 * Concentra as validações negociais dos serviços de prova
 */
class ProvaValidator
{
    
    /**
     * Repository de Prova
     *
     * @var ProvaRepository
     */
    protected $repository;

    /**
     * Construtor para injeção das dependências
     *
     * @param ProvaRepository $repository
     */
    public function __construct(ProvaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Realiza as validações negociais do cadastro de provas
     *
     * @param array $data
     * @return array
     */
    public function cadastrarValidation(array $data)
    {
        // Verifica a existência do tipo de prova
        if(!in_array($data['tipo'], Prova::TIPOS)){
            return ['success' => false, 'msg' => 'Tipo de prova inexistente'];
        }
        
        return ['success' => true, 'msg' => ''];
    }
}
