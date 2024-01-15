<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ApiMahasiswa extends RestController 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa');
    }
    
    public function index_get() {
        $mahasiswa_model = new Mahasiswa();
        $mahasiswa = $mahasiswa_model->get_mahasiswa();
        $this->response($mahasiswa, 200);
    }

    public function addMahasiswa_post(){
        $mahasiswa_model =  new Mahasiswa();
        $mahasiswa = [
            'nama' => $this->input->post('nama'),
            'nim' => $this->input->post('nim'),
            'jurusan' => $this->input->post('jurusan'),
            'alamat' => $this->input->post('alamat'),
        ];
        $result = $mahasiswa_model->add_mahasiswa($mahasiswa);
        if($result > 0){
            $this->response([
                'status' => 'true',
                'message' => 'Mahasiswa has successfully added'
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'status' => 'false',
                'message' => 'Mahasiswa not added'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function findMahasiswa_get($id){
        $mahasiswa_model =  new Mahasiswa();
        // $id = $this->input->post('id');
        $result = $mahasiswa_model->find_mahasiswa($id);
        $this->response($result, 200);
    }

    public function editMahasiswa_post($id){
        $mahasiswa_model =  new Mahasiswa();
        $mahasiswa = [
            'nama'=>$this->input->post('nama'),
            'nim'=>$this->input->post('nim'),
            'jurusan'=>$this->input->post('jurusan'),
            'alamat'=>$this->input->post('alamat'),
        ];
        
        // $this->response($mahasiswa);
        $editResult = $mahasiswa_model->update_mahasiswa($id, $mahasiswa);
        if($editResult > 0) {
            $this->response([
                'status' => true,
                'message' => 'Updated Successfully'
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Update failed'
            ], RestController::HTTP_BAD_REQUEST);
        }
        
    }

    public function deleteMahasiswa_delete($id){
        $mahasiswa_model =  new Mahasiswa();
        $result = $mahasiswa_model->delete_mahasiswa($id);
        if($result > 0){
            $this->response([
                'status' => 'true',
                'message' => 'Deleted Successfully',
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'status' => 'false',
                'message' => 'Delete failed',
            ], RestController::HTTP_BAD_REQUEST);
        }
        
    }
}