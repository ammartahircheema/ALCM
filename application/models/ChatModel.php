<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ChatModel extends CI_Model {

    // Data Members
    private $table_name = 'chat';
    private $id = 'id';
    private $userid = 'userid';
    private $department = 'department';
    private $msg = 'msg';

    // Enter User Function
    public function insertMsg($userid, $department, $msg) {
        $data = array(
            $this->userid => $userid,
            $this->department => $department,
            $this->msg => $msg
        );
        $this->db->insert($this->table_name, $data);
    }

    // Get Users Functions
    public function getChatByDept($department) {
        $this->db->where("department", $department);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

}
