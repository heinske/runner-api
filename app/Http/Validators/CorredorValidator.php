<?php

namespace App\Http\Validators;

use App\Repository\CorredorRepository;

/**
 * Concentra as validações negociais dos serviços de Corredor
 */
class CorredorValidator
{
    
    /**
     * Repository de Corredor
     *
     * @var CorredorRepository
     */
    protected $repository;

    /**
     * Construtor para injeção das dependências
     *
     * @param CorredorRepository $repository
     */
    public function __construct(CorredorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Realiza as validações negociais do cadastro de corredor
     *
     * @param array $data
     * @return array
     */
    public function cadastrarValidation(array $data)
    {
        // Verifica se o corredor é menor de idade
        $idade = (new \DateTime())->format('Y') - (new \DateTime($data['data_nascimento']))->format('Y');
        $idade = (new \DateTime())->format('md') < (new \DateTime($data['data_nascimento']))->format('md') ? $idade - 1 : $idade;
        
        if($idade < 18){
            return ['success' => false, 'msg' => 'O corredor deve ter mais de 18 anos!'];
        }

        return ['success' => true, 'msg' => ''];
    }
}
