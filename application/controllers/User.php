<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("UserModel");
        $this->load->model("ChatModel");
        $this->load->model("NotificationModel");
    }

    public function xlogin($msg) {
        $data = array('msg' => $msg);
        $this->load->view("login", $data);
    }

    public function validate() {
        if ($this->session->userdata('email') != NULL || $this->session->userdata('email') != "") {
            if ($this->session->userdata('isAdmin') == 1) {
                redirect(base_url() . 'Admin/Index');
            }
        } else {
            redirect(base_url() . 'Home/Index');
        }
    }

    public function login() {
        $this->load->view("login");
    }

    public function Chat() {
        $user = $this->UserModel->getUserByEmail($this->session->userdata('email'));
        foreach ($user as $value) {
            $department = $value->department;
        }
        $this->session->set_userdata('department', $department);
        $results = $this->ChatModel->getChatByDept($department);
        $data = array('result' => $results);
        $this->load->view('UserChat', $data);
    }

    public function sendMsg() {
        $user = $this->UserModel->getUserByEmail($this->session->userdata('email'));
        foreach ($user as $value) {
            $department = $value->department;
            $id = $value->id;
        }
        if ($this->input->post()) {
            $msg = $this->input->post('msg');
            $this->ChatModel->insertMsg($id, $department, $msg);
        }
        $results = $this->ChatModel->getChatByDept($department);
        $data = array('result' => $results);
        $this->load->view('UserChat', $data);
    }

    public function Register() {
        $this->load->view('Register');
    }

    public function xRegister($msg) {
        $data = array('msg' => $msg);
        $this->load->view("Register", $data);
    }

    public function Logout() {
        $this->session->sess_destroy();
        $this->load->view('home');
    }

    public function Index() {
        $this->validate();
        $user = $this->UserModel->getUserByEmail($this->session->userdata('email'));
        foreach ($user as $value) {
            $batch = $value->batch;
            $department = $value->department;
            $id = $value->id;
        }
        $results = $this->NotificationModel->getNotification($department, $batch);
        $data = array('results' => $results);
        $this->load->view("UserHome", $data);
    }

    public function UpdateProfile() {
        $this->validate();
        if ($this->session->userdata('email') != NULL || $this->session->userdata('email') != "") {
            $results = $this->UserModel->getUserByEmail($this->session->userdata('email'));
            //$results=$this->session->userdata('email');
            $data = array('result' => $results);
            $this->load->view('UserProfileUpdate', $data);
        } else
            redirect(base_url() . 'Home/Index');
        //getUserByEmail
    }

    public function xUpdateProfile($msg) {
        $this->validate();
        if ($this->session->userdata('email') != NULL || $this->session->userdata('email') != "") {
            $results = $this->UserModel->getUserByEmail($this->session->userdata('email'));
            //$results=$this->session->userdata('email');
            $data = array('result' => $results, 'msg' => $msg);
            $this->load->view('UserProfileUpdate', $data);
        } else
            redirect(base_url() . 'Home/Index');
        //getUserByEmail
    }

    public function ProcessLogin() {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            //$password = md5(sha1(md5($p)));
            if ($this->UserModel->isUserExists($email, $password)) {
                $this->session->set_userdata('email', $email);
                $isAdmin = 0;
                if ($this->UserModel->isAdmin($email)) {
                    $isAdmin = 1;
                }
                $this->session->set_userdata('isAdmin', $isAdmin);
                echo "<div class='alert alert-success'><strong>Login Successful, Redirecting...</strong></div>" .
                "<script type='text/javascript'>
				window.setTimeout(function(){
					window.location.href = '" . base_url() . "User/Index';
				}, 1000);
				</script>";
            } else {
                redirect(base_url() . 'User/xLogin/Invalid Username or Password');
            }
        }
    }

    public function ProcessRegister() {
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $batch = $this->input->post('batch');
            $department = $this->input->post('department');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            //$password = md5(sha1(md5($p)));
            if ($this->UserModel->isEmailExists($email)) {
                redirect(base_url() . 'User/xRegister/Email Id is already in use');
            } else {//($name, $batch, $photo, $department, $email, $password)
                $this->UserModel->insertUser($name, $batch, "user.png", $department, $email, $password);
                redirect(base_url() . 'User/xRegister/User Succesfully Registered');
            }
        }
    }

    public function ProcessUpdate() {
        $this->validate();
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $batch = $this->input->post('batch');
            $department = $this->input->post('department');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            //$password = md5(sha1(md5($p)));
            if ($this->UserModel->updateUser($name, $batch, $department, $email, $password)) {
                redirect(base_url() . 'User/xUpdateProfile/Succesfully Updated');
            } else {//($name, $batch, $photo, $department, $email, $password)
                redirect(base_url() . 'User/xUpdateProfile/Something Went Wrong');
            }
        }
    }

}
