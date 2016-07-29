<?php

/**
 * Class UsuarioModel.
 */
class ModelLog extends ModelBase
{
    protected $table = 'api_log';

    /**
     * @return mixed
     */
    public function listar()
    {
        return  $this->db->get($this->table);
    }
}
