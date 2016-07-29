<?php

/**
 * Class UsuarioModel.
 */
class ModelUsuario extends ModelBase
{
    protected $table = 'usuario';
    public $nombre = '';
    public $email = '';

    /**
     * UsuarioModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @author Pedro Rodriguez <li.antoniors@gmail.com>
     */
    public function registrar($request)
    {
        $this->nombre = $request['nombre'];
        $this->email = $request['email'];

        $this->db->insert($this->table, $this);
    }

    /**
     * @author Pedro Rodriguez <li.antoniors@gmail.com>
     */
    public function actualizar($request)
    {
        $this->nombre = $request['nombre'];
        $this->email = $request['email'];


        $this->db->update($this->table, $this, ['id' => $request['id']]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function obtener($id)
    {
        return  $this->db->where('id', $id)->get($this->table);
    }

    /**
     * @return mixed
     */
    public function listar()
    {
        return  $this->db->get($this->table);
    }
}
