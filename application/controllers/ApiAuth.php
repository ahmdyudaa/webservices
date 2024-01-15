<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ApiAuth extends RestController{
    public function __construct(){
        parent::__construct();
        $this->load->model('Auth');
    }
    public function login_post(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $authModel = new Auth();
        $result = $authModel->login($username, $password);

        if($result){
            $this->response([
                'status' => true,
                'message' => "Login successful",
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => "Login failed",
            ], RestController::HTTP_BAD_REQUEST);
        }     
        
    }

    public function register_post(){

        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );

        $authModel = new Auth();
        $result = $authModel->register($data);

        if ($result) {
            $this->response([
                'status' => true,
                'message' => "Registration successfully",
            ],RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => "Register failed",
            ], RestController::HTTP_BAD_REQUEST);
        }     
        
    }

} 