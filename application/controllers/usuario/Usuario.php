<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/controllers/BaseController.php';

class Usuario extends BaseController
{
    protected $javascripts = ['js/angular/usuario/usuario.js'];

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->load->view($this->template,
            [
                'content'     => $this->load->view('usuario/captura', [], true),
                'javascripts' => $this->getJavascripts(),
            ]
        );
    }

    public function listar()
    {
        return $this->load->view($this->template,
            [
                'content'     => $this->load->view('usuario/lista', [], true),
                'javascripts' => $this->getJavascripts(),
            ]
        );
    }
}
