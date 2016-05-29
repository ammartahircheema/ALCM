<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModel extends CI_Model {

    // Data Members
    private $table_name = 'user';
    private $id = 'id';
    private $name = 'name';
    private $batch = 'batch';
    private $photo = 'photo';
    private $department = 'department';
    private $email = 'email';
    private $password = 'password';
    private $isActive = 'isActive';
    private $isAdmin = 'isAdmin';

    function getAlumni() {
        $this->db->where("isActive", 1);
        $this->db->where("isAdmin", 0);
        $this->db->where("batch", 0);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    function getALl() {

        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    function updateName($id, $name) {
        $data = array(
            "name" => $name
        );
        $this->db->where("id", $id);
        $this->db->update($this->table_name, $data);
    }

}
