<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("AdminModel");
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

}
