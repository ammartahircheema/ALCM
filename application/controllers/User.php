<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("UserModel");
        $this->load->model("ChatModel");
        $this->load->model("NotificationModel");
        $this->load->helper('cookie');
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
        delete_cookie("email");
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

    public function UserPhoto() {
        $this->validate();
        if ($this->session->userdata('email') != NULL || $this->session->userdata('email') != "") {
            $results = $this->UserModel->getUserByEmail($this->session->userdata('email'));
            //$results=$this->session->userdata('email');
            $data = array('result' => $results);
            $this->load->view('UserPhoto', $data);
        } else
            redirect(base_url() . 'Home/Index');
        //getUserByEmail
    }
    public function xUserPhoto() {
        $this->validate();
            $target_dir = "uploads/";

            $user = $this->UserModel->getUserByEmail($this->session->userdata('email'));
            foreach ($user as $value) {
                $department = $value->department;
                $id = $value->id;
            }
            $target_file =  $target_dir . $id.'.jpg';
            //var_dump($id);var_dump($target_dir);die();
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            $msg=" ";
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $msg = "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $msg =  "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
//            if (file_exists($target_file)) {
//                $msg =  "Sorry file already exists.";
//                $uploadOk = 0;
//            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                $msg =  "Sorry your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $msg =  "Sorry only JPG JPEG PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $msg .=  "Sorry your file was not uploaded.";
            // if everything is ok try to upload file
            } else {
                //var_dump($target_file);
                //die();
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $msg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    $email=$this->session->userdata('email');
                    $this->UserModel->updateUserPhoto($email, $id.'.jpg');
                } else {
                    $msg = "Sorry there was an error uploading your file.";
                }
            }

            $data = array( 'msg' => $msg);
            $this->load->view('UserPhoto', $data);
        
        if ($this->session->userdata('email') != NULL || $this->session->userdata('email') != "") {
            $results = $this->UserModel->getUserByEmail($this->session->userdata('email'));
            //$results=$this->session->userdata('email');
            $data = array('result' => $results);
            $this->load->view('UserPhoto', $data);
        } else
            redirect(base_url() . 'Home/Index');
        //getUserByEmail
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
  $cookie= array(
      'name'   => 'email',
      'value'  => $email,
       'expire' => '86500',
  );
  $this->input->set_cookie($cookie);
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
