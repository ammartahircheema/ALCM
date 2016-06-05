<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationModel extends CI_Model {

    // Data Members
    private $table_name = 'notification';
    private $id = 'id';
    private $title = 'title';
    private $msg = 'msg';
    private $batch = 'batch';
    private $department = 'department';

    public function insertNotification($title, $msg, $department, $batch) {
        $data = array(
            $this->title => $title,
            $this->msg => $msg,
            $this->department => $department,
            $this->batch => $batch
        );
        $this->db->insert($this->table_name, $data);
    }

    // Get Users Functions
    public function getNotification($department, $batch) {
        $this->db->where('department', $department);
        $this->db->or_where('department', null);
        $this->db->or_where('department', '');
        $this->db->where('batch', $batch);
        $this->db->or_where('batch', null);
        $this->db->or_where('batch', '');
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

}
