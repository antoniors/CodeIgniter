<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class LogApi extends REST_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('api/Model_Api', 'ModelApi');
    }

    public function logs_get()
    {

        $this->set_response($this->ModelApi->log(), REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }


}
