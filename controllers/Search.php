<?php
class Search extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    session_start();
  }

//Load the search view
  public function index() {
    $this->load->view('Search');
  }

// Load the model which attempts the search
// once the string has been searched then load view messages 
  public function dosearch() {
    $this->load->helper('url');
    $this->load->model('Messages_model');
    $string = $this->input->get('search');
    $this->Messages_model->searchMessage($string);
    $data['messages'] = $this->Messages_model->searchMessage();
    $data['user'] = null;
    $data['link'] = null;
    $this->load->view('ViewMessages', $data);
  }
}
