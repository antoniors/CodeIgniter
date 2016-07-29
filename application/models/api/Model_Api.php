<?php

/**
 * Created by PhpStorm.
 * User: SISNOM
 * Date: 20/05/2016
 * Time: 18:00.
 */
class Model_Api extends ModelBase
{
    protected $table = 'api_logs';

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
    public function log()
    {
        return  $this->db->get($this->table)->result();
    }
}
