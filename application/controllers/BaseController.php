<?php

/**
 * Created by PhpStorm.
 * User: SISNOM
 * Date: 20/05/2016
 * Time: 16:19
 */
class BaseController extends CI_Controller
{

    protected $template=null;
    public function __construct ()
    {
        parent::__construct();

        if(is_null($this->template)){
            $this->template = 'layouts/master';
        }



    }

    public function response ( ) {
        return new ResponseAjax();
    }
}