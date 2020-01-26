<?php
class User extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      session_start();
    }

// loads the view which displays all of the users messages
// And who's message page it is
    public function view($name = null) {

      $this->load->model('Messages_model');
      $this->Messages_model->getMessagesByPoster($name);
      $data['messages'] = $this->Messages_model->getMessagesByPoster($name);
      $data['user'] = "<div id = name>$name's Messages<br>";
      $data['link'] = "<a href = ".site_url()."/user/feed/$name>View $name's Feed</a></div>";
      $data['follow'] = null;

// Displays a link if the logged in user follows the user that they are viewing
      if (isset($_SESSION['user'])) {
        if ($_SESSION['user'] != $name) {
          $this->load->database('default');
          $this->db->reset_query();
          $this->load->model('Users_model');

          $ask = $this->Users_model->isFollowing($_SESSION['user'], $name);
          if ($ask) {
            $data['follow'] = "<a href = ".site_url()."/user/unFollow/$name>Unfollow $name</a>";
          }
          else {
            $data['follow'] = "<a href = ".site_url()."/user/Follow/$name>Follow $name</a>";
          }
        }

      }

      $this->load->view('ViewMessages', $data);


    }

// Loads the login view
    public function login() {
      $this->load->view('Login');
    }
// Loads the message view if the login details are incorrect
// else display an alert message and load the login page
    public function doLogin() {
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $this->load->model('Users_model');
      $this->Users_model->checkLogin($username, $password);

      if ($this->Users_model->checkLogin() == true) {
        header("Location: ".site_url()."/User/view/".$username);
        $_SESSION['user'] = $username;
      }
      else {
        $message = "Username or Password is incorrect";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $this->load->view('Login');
      }
    }

// Destroys the session which logs out the user, then displays the login page
    public function logout() {
      $this->load->view('Login');
      session_destroy();
    }

// Follows the user which is being viewed
    public function follow($followed) {
      $this->load->model('Users_model');
      $this->Users_model->follow($followed);
      header("Location: ".site_url()."/User/view/".$followed);
    }

// Unfollows the user which is being viewed
    public function unFollow($followed) {
      $this->load->model('Users_model');
      $this->Users_model->unFollow($followed);
      header("Location: ".site_url()."/User/view/".$followed);
    }

// Very similar to the view function,
// but displays the users feed instead of their messages
    public function feed($name = null) {
      $this->load->model('Messages_model');
      $this->Messages_model->getFollowedMessages($name);
      $data['messages'] = $this->Messages_model->getFollowedMessages($name);
      $data['user'] = "<div id = name>$name's feed<br>";
      $data['link'] = "<a href = ".site_url()."/user/view/$name>View $name's Messages</a></div>";
      $data['follow'] = null;

      if (isset($_SESSION['user'])) {
        if ($_SESSION['user'] != $name) {
          $this->load->database('default');
          $this->db->reset_query();
          $this->load->model('Users_model');
          if ($this->Users_model->isFollowing($_SESSION['user'],$name) == true) {
            $data['follow'] = "<a href = ".site_url()."/user/unFollow/$name>Unfollow $name</a>";
          }
          else {
            $data['follow'] = "<a href = ".site_url()."/user/Follow/$name>Follow $name</a>";
          }
        }
      }


      $this->load->view('ViewMessages', $data);
    }
  }
  ?>
