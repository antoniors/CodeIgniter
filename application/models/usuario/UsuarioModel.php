<?php

/**
 * Class UsuarioModel
 */
class Model_Usuario extends ModelBase
{
    protected $table = 'api_logs';
    var $nombre = '';
    var $email = '';
    var $password = '';

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
        $this->password = $request['password'];

        $this->db->insert($this->table, $this);
    }

    /**
     * @author Pedro Rodriguez <li.antoniors@gmail.com>
     */
    function actualizar ($request)
    {
        $this->nombre = $request['nombre'];
        $this->email = $request['email'];
        $this->password = $request['password'];


        $this->db->update($this->table, $this, array( 'id' => $request['id'] ));
    }

    function listar() {
        return  $this->db->get($this->table);
    }
}