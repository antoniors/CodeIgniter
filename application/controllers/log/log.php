<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/BaseController.php';

class Log extends BaseController
{
    protected $javascripts = ['js/angular/log/log.js'];

    function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        return $this->load->view($this->template,
            [
                'content' => $this->load->view('log/lista', [], true),
                'javascripts' => $this->getJavascripts()
            ]
        );
    }
}