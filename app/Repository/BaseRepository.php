<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

/**
 * Concentra as regras de negócio 
 * 
 * @author Eduardo Praxedes Heinske <praxeduardo@gmail.com>
 */
abstract class BaseRepository
{

    /**
     * Model
     *
     * @var Model
     */
    protected $model;

    /**
     * Método genérico de cadastro / alteração
     *
     * @param array $data
     * @return boolean
     */
    public function save(array $data)
    {
        if(isset($data['id']) && !empty($data['id'])) {
            return $this->atualizar($data);
        }else{
            return $this->cadastrar($data);
        }
    }

    /**
     * Cadastro
     *
     * @param array $data
     * @return boolean|Model
     */
    public function cadastrar(array $data)
    {
        $save = $this->model->fill($data)->save();
        return $save ? $this->model : false;
    }

    /**
     * Alteração
     *
     * @param array $data
     * @return boolean|Model
     */
    public function atualizar(array $data)
    {
        $model = $this->model->find($data['id']);
        $save = $model->fill($data)->save();
        return $save ? $model : false;
    }

    /**
     * Busca por um registro por id
     *
     * @param integer $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }
}
