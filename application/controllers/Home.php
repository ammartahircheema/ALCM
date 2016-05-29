<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("HomeModel");
    }

    public function Index() {
        $this->load->view('Home');
    }

    public function Login() {
        $this->load->view('Login');
    }

    public function Alumni() {
        $results = $this->HomeModel->getAlumni();
        $data = array('results' => $results);
        $this->load->view('Alumni', $data);
    }

    public function About() {
        $this->load->view('About');
    }

    public function Contact() {
        $this->load->view('Contact');
    }

}
