<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("AdminModel");
        $this->load->model("NotificationModel");
    }

    public function validate() {
        if ($this->session->userdata('email') != NULL || $this->session->userdata('email') != "") {
            if ($this->session->userdata('isAdmin') == 0) {
                redirect(base_url() . 'User/Index');
            }
        } else {
            redirect(base_url() . 'Home/Index');
        }
    }

    public function Logout() {
        $this->session->sess_destroy();
        $this->load->view('home');
    }

    public function setActive($id) {
        $this->validate();
        $this->AdminModel->setActive($id);
        $result = $this->AdminModel->getInActiveUsers();
        $result2 = $this->AdminModel->getActiveUsers();
        $data = array('results' => $result, 'InActive' => $result2);
        $this->load->view('AdminHome', $data);
    }

    public function setInActive($id) {
        $this->validate();
        $this->AdminModel->setInActive($id);
        $result = $this->AdminModel->getInActiveUsers();
        $result2 = $this->AdminModel->getActiveUsers();
        $data = array('results' => $result, 'InActive' => $result2);
        $this->load->view('AdminHome', $data);
    }

    public function Index() {
        $this->validate();
        $result = $this->AdminModel->getInActiveUsers();
        $result2 = $this->AdminModel->getActiveUsers();
        $data = array('results' => $result, 'InActive' => $result2);
        $this->load->view('AdminHome', $data);
    }
    public function Notification() {
        $this->validate();
        $this->load->view('AdminNotification');
    }
    public function xNotification($msg) {
        $this->validate();
        $data = array('msg' => $msg);
        $this->load->view('AdminNotification', $data);
    }
    public function ProcessNotification() {
        $this->validate();
        if ($this->input->post()) {
            $title = $this->input->post('title');
            $msg = $this->input->post('msg');
            $batch = $this->input->post('batch');
            $department = $this->input->post('department');
            
            $this->NotificationModel->insertNotification($title, $msg, $department, $batch);
            
            $data = array('msg' => 'Notifiation sent successfully');
            $this->load->view('AdminNotification', $data);
        }
        $data = array('msg' => 'Somrthing went wrong');
        $this->load->view('AdminNotification', $data);
    }

}
