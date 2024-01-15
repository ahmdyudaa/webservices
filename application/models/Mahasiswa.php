<?php

class Mahasiswa extends CI_Model
{
    public function get_mahasiswa(){
        $mahasiswa = $this->db->get('mahasiswa')->result();
        return $mahasiswa;
    }

    public function add_mahasiswa($mahasiswa){
        $mahasiswa = $this->db->insert('mahasiswa', $mahasiswa);
        return $mahasiswa;
    }

    public function find_mahasiswa($id){
        $this->db->where('id', $id);
        $query = $this->db->get('mahasiswa');
        return $query->row();
    }

    public function update_mahasiswa($id, $mahasiswa){
        $this->db->where('id', $id);
        $query = $this->db->update('mahasiswa', $mahasiswa);
        return $query;
    }

    public function delete_mahasiswa($id){
        $this->db->where('id', $id);
        return $this->db->delete('mahasiswa');
    }
    
}