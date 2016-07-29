<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/controllers/BaseController.php';

class log extends BaseController
{
    protected $javascripts = ['js/angular/log/log.js'];

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->load->view($this->template,
            [
                'content'     => $this->load->view('log/lista', [], true),
                'javascripts' => $this->getJavascripts(),
            ]
        );
    }
}
