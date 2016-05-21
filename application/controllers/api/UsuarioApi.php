<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class UsuarioApi extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('usuario/ModelUsuario');
    }


    public function usuarios_get($id = null)
    {


        if ($id === null) {
            $users = $this->ModelUsuario->listar()->result();

            if ($users) {
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => false,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }


        if ((int)$id <= 0) {
            $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }


        $user = null;


        $user = $this->ModelUsuario->obtener($id)->result();

        if (!empty($user)) {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => false,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function usuarios_post()
    {

        $request = json_decode(file_get_contents('php://input'), true);

        try {
            $this->ModelUsuario->registrar($request);
            $this->response([
                'response' => 'success',
                'message' => "Usuario registrado correctamente"
            ], REST_Controller::HTTP_CREATED);
        } catch (Exception $e) {
            $this->response([
                'response' => 'error',
                'message' => "Usuario registrado correctamente",
                'error' => $e
            ], REST_Controller::HTTP_CREATED);
        }

    }


}
