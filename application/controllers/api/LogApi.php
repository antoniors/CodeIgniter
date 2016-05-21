<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class LogApi extends REST_Controller {




    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/Model_Api','ModelApi');
    }

    public function log_get()
    {

        $this->set_response( $this->ModelApi->log(), REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }


}
