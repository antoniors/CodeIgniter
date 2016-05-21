<?php

defined('BASEPATH') OR exit( 'No direct script access allowed' );

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/controllers/BaseController.php';

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
class Usuario extends BaseController
{

    function __construct ()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index ()
    {

        //return ($this->load->view('usuario/captura',true) );
        return $this->load->view($this->template,
            array( 'content' => $this->load->view('usuario/captura',[],true))
        );
    }
}
