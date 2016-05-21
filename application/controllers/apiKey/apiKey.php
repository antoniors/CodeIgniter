<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/BaseController.php';

class ApiKey extends BaseController
{
    protected $javascripts = ['js/angular/apiKey/apiKey.js'];

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->load->view($this->template,
            [
                'content' => $this->load->view('apiKey/obtener', [], true),
                'javascripts' => $this->getJavascripts()
            ]
        );
    }

    public function listar()
    {
        return $this->load->view($this->template,
            [
                'content' => $this->load->view('apiKey/lista', [], true),
                'javascripts' => $this->getJavascripts()
            ]
        );
    }
}
