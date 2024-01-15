<?php

class Auth extends CI_Model
{
    public function login($username, $password){
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('user')->row_array();
        return $query;

        // $this->db->select("*");
        // $this->db->from("user");
        // $this->db->where("username", $username);
        // $query = $this->db->get('user');
        // $user = $query->row_array();
        
        // if (!empty($user)) {
        //     echo "masuk1";
        //     if (password_verify($password, $user['password'])) {
        //         echo "masuk";
        //         return $query->result();
        //     } else {
        //         return false;
        //     }
        // } else {
        //     return false;
        // }
    }

    public function register($data){
        return $this->db->insert('user', $data);
    }
}