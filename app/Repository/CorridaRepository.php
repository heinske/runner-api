<?php

namespace App\Repository;

use App\Model\Corrida;
use Illuminate\Database\Eloquent\Collection;
use DB;

/**
 * Concentra as regras de negócio das corridas dos corredores
 * 
 * @author Eduardo Praxedes Heinske <praxeduardo@gmail.com>
 */
class CorridaRepository extends BaseRepository
{

    /**
     * Modelo de corrida
     *
     * @var Corrida
     */
    protected $model;

    /**
     * Contrutor para injeção das dependências
     *
     * @param Corrida $corrida
     */
    public function __construct(Corrida $corrida)
    {
        $this->model = $corrida;
    }   
    
    /**
     * Busca de corridas
     *
     * @param array $filtros
     * @return Collection
     */
    public function busca(array $filtros = [])
    {
        $q = $this->model;

        if(isset($filtros['prova_id']) && !empty($filtros['prova_id'])){
            $q = $q->where('prova_id', $filtros['prova_id']);
        }

        if(isset($filtros['corredor_id']) && !empty($filtros['corredor_id'])){
            $q = $q->where('corredor_id', $filtros['corredor_id']);
        }

        return $q;
    }

    public function gerarRelatorioGeral()
    {
        $corridas = $this->model
                  ->select(DB::raw('
                  provas.id as id_prova, 
                  provas.tipo as tipo, 
                  corredores.id as id_corredor,
                  corredores.nome as nome_corredor,
                  AGE(corredores.data_nascimento) as idade,
                  (corridas.hora_termino - corridas.hora_inicio) AS tempo_prova'))
                  ->join('provas', 'provas.id', '=', 'corridas.prova_id')
                  ->join('corredores', 'corredores.id', '=', 'corridas.corredor_id')
                  ->orderBy('provas.id', 'desc')
                  ->orderBy('tempo_prova', 'asc')
                  ->get();

        $result = [];
        $posicoes = [];
        foreach($corridas as $corrida){
            // Isola a idade
            $idade = explode(' years', $corrida->idade);
            $corrida['idade'] = $idade[0].' Anos';

            // Calcula a posição
            $corrida['tipo'] = $corrida['tipo'].' Km';
            if(isset($posicoes[$corrida->tipo])){
                $posicoes[$corrida->tipo]++; 
            }else{
                $posicoes[$corrida->tipo] = 1;
            }

            $corrida['posicao'] = $posicoes[$corrida->tipo];

            $result[$corrida->id_prova][] = $corrida;
        }

        return $result;
    }

    public function gerarRelatorioIdade()
    {
        $corridas = $this->model
                         ->select(DB::raw('
                            provas.id as id_prova, 
                            provas.tipo as tipo, 
                            corredores.id as id_corredor,
                            corredores.nome as nome_corredor,
                            AGE(corredores.data_nascimento) as idade,
                            (corridas.hora_termino - corridas.hora_inicio) AS tempo_prova'))
                        ->join('provas', 'provas.id', '=', 'corridas.prova_id')
                        ->join('corredores', 'corredores.id', '=', 'corridas.corredor_id')
                        ->orderBy('tempo_prova', 'asc')
                        ->get();

        
        $result = [];
        $posicoes = [];
        foreach($corridas as $corrida){
            // Isola a idade
            $idade = explode(' years', $corrida->idade);
            $corrida['idade'] = $idade[0].' Anos';
            $faixa = $this->enquadrarFaixaEtaria($corrida['idade']);

            // Enquadra a idade
            $corrida['tipo'] = $corrida['tipo'].' Km';
            $corrida['faixa_etaria'] = $faixa['descricao'];
            
            // Calcula a posição
            if(isset($posicoes[$faixa['codigo']])){
                $posicoes[$faixa['codigo']]++; 
            }else{
                $posicoes[$faixa['codigo']] = 1;
            }

            $corrida['posicao'] = $posicoes[$faixa['codigo']];

            $result[$faixa['codigo']][] = $corrida;
        }

        return $result;
    }

    public function enquadrarFaixaEtaria($idade)
    {
        switch($idade){
            case $idade >= 18 && $idade <= 25:
                return ['codigo' => 'faixa_01', 'descricao' => '18 a 35 anos'];
                break; 
            case $idade > 25 && $idade <= 35:
                return ['codigo' => 'faixa_01', 'descricao' => '26 a 35 anos'];
                break; 
            case $idade > 35 && $idade <= 45:
                return ['codigo' => 'faixa_01', 'descricao' => '26 a 45 anos'];
                break; 
            case $idade > 45 && $idade <= 55:
                return ['codigo' => 'faixa_01', 'descricao' => '46 a 55 anos'];
                break; 
            case $idade > 55:
                return ['codigo' => 'faixa_01', 'descricao' => 'Acima de 35 anos'];
                break; 
        }
    }

}
