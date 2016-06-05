<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

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

    // Enter User Function
    public function insertUser($name, $batch, $photo, $department, $email, $password) {
        $data = array(
            $this->name => $name,
            $this->batch => $batch,
            $this->photo => $photo,
            $this->department => $department,
            $this->email => $email,
            $this->password => $password,
            $this->isActive => 0,
            $this->isAdmin => 0
        );
        $this->db->insert($this->table_name, $data);
    }

    function updateUser($name, $batch, $department, $email, $password) {
        $data = array(
            "name" => $name,
            "batch" => $batch,
            "department" => $department,
            "email" => $email,
            "password" => $password
        );
        $this->db->where("email", $email);
        $this->db->update($this->table_name, $data);
        return true;
    }
    function updateUserPhoto($email, $photo) {
        $data = array(
            "photo" => $photo
        );
        $this->db->where("email", $email);
        $this->db->update($this->table_name, $data);
        return true;
    }

    // Get Users Functions
    public function getUsers() {
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    // Get Users Functions
    public function getUserByEmail($email) {
        $this->db->where("email", $email);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    public function getUserById($id) {
        $this->db->where("id", $id);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    // Function Check Existing Email
    public function isEmailExists($email) {
        $this->db->where($this->email, $email);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
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

    // Remove User
    public function removeUserByID($id) {
        $this->db->where($this->UserID, $id);
        if ($this->db->delete($this->table_name)) {
            return true;
        } else {
            return false;
        }
    }

    // Remove User
    public function removeUserByEmail($email) {
        $this->db->where($this->email, $email);
        if ($this->db->delete($this->table_name)) {
            return true;
        } else {
            return false;
        }
    }

}
