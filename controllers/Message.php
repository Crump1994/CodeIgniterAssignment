<?php
class Message extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      session_start();
    }

// if the user is logged in then load the post view
// else load the login view
    public function index() {
      if (isset($_SESSION['user'])) {
        $this->load->view('Post');
      }
      else {
        $this->load->view('Login');
      }
    }
// If the user is logged in then get the message from the post view
// and input that into the database under the logged in user
// else load the login view
    public function doPost() {
      $string = $this->input->post('post');
      if (isset($_SESSION['user'])) {
        $this->load->model('Messages_model');
        $this->Messages_model->insertMessage($_SESSION['user'], $string);
        header("Location: ".site_url()."/User/view/".$_SESSION['user']);
      }
      else {
        $this->load->view('Login');
      }
    }
}
