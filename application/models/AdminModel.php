<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

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

    // Get Users Functions
    public function getUsers() {
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    // Get Users Functions
    public function getActiveUsers() {
        $this->db->where("isActive", 1);
        $this->db->where("isAdmin", 0);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    // Get Users Functions
    public function getInActiveUsers() {
        $this->db->where("isActive", 0);
        $this->db->where("isAdmin", 0);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    function setActive($id) {
        $data = array(
            "isActive" => 1
        );
        $this->db->where("id", $id);
        $this->db->update($this->table_name, $data);
    }

    function setInActive($id) {
        $data = array(
            "isActive" => 0
        );
        $this->db->where("id", $id);
        $this->db->update($this->table_name, $data);
    }

    // Get Users Functions
    public function getUserByEmail($email) {
        $this->db->where("email", $email);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    // Function User Exists
    public function isUserExists($email, $password) {
        $this->db->where($this->email, $email);
        $this->db->where($this->password, $password);
        $this->db->where("( " . $this->isActive . "='1')");
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    // Function Admin Exists
    public function isAdmin($email) {
        $this->db->where($this->email, $email);
        $this->db->where($this->isAdmin, 1);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

}
