<?php

/**
 * Class UsuarioModel
 */
class ModelUsuario extends ModelBase
{
    protected $table = 'usuario';
    var $nombre = '';
    var $email = '';

    /**
     * UsuarioModel constructor.
     */
    function __construct ()
    {
        parent::__construct();
    }


    /**
     * @author Pedro Rodriguez <li.antoniors@gmail.com>
     */
    function registrar ($request)
    {
        $this->nombre = $request['nombre'];
        $this->email = $request['email'];

        $this->db->insert($this->table, $this);
    }

    /**
     * @author Pedro Rodriguez <li.antoniors@gmail.com>
     */
    function actualizar ($request)
    {
        $this->nombre = $request['nombre'];
        $this->email = $request['email'];


        $this->db->update($this->table, $this, array( 'id' => $request['id'] ));
    }

    /**
     * @param $id
     * @return mixed
     */
    function obtener($id) {
        return  $this->db->where('id',$id)->get($this->table);
    }

    /**
     * @return mixed
     */
    function listar() {
        return  $this->db->get($this->table);
    }
}