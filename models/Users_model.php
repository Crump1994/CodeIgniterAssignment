<?php
class Users_model extends CI_model {

  // checks the login details to see if they match
  // if the login details match then return true orwise return false
  function checkLogin($username = null, $pass = null) {
    $this->load->database('default');
    $query = $this->db->get('Users');
    $this->db->where('username', $username);
    $this->db->where('password', sha1($pass));

    if($query->num_rows() > 0) {
      return true;
    }
    else {
      return false;
    }
  }

//checks if the logged in user if following the user that's being viewed
//returns true if the user is being followed otherwise it returns false
  function isFollowing($follower = null, $followed = null) {
      $this->load->database('default');
      $query = $this->db->get('User_Follows');
      $this->db->where('follower_username', $follower);
      $this->db->where('followed_username', $followed);

      $sql = "SELECT * FROM `User_Follows` WHERE `follower_username` = ? AND `followed_username` = ?";
      $query = $this->db->query($sql, array($follower, $followed));

      if($query->num_rows() > 0){
        return true;
      }
      else {
        return false;
      }
  }

//inserts the user that is logged in and the user being followed into the database
  function follow($followed) {

    $this->load->database('default');
    $data = array(
      'follower_username' => $_SESSION['user'],
      'followed_username' => $followed
    );
    $this->db->insert('User_Follows', $data);
  }

// deletes the line where the follower is the person logged in
// and the person being followed is passed through as a parameter
  function unFollow($followed) {
    $this->load->database('default');
    $this->db->where('follower_username', $_SESSION['user']);
    $this->db->where('followed_username', $followed);
    $this->db->delete('User_Follows');
  }
}
?>
