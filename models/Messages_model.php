<?php
class Messages_model extends CI_model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

// find all of the messages by a specific user
// then return the result of the query
  function getMessagesByPoster($name = null) {
    $query = $this->db->get('Messages');
    $this->db->where('user_username', $name);
    $this->db->order_by('posted_at', 'desc');

    return $query->result();
  }

// Search the message table with a specific string
// return all messages that include that string
  function searchMessage($string = null) {
    $query = $this->db->get('Messages');
    $this->db->like('text', $string);
    $this->db->order_by('posted_at', 'desc');
    return $query->result();
  }

// recives the person posting and the string they would like to post
// the inserts that data into the message table with the time added
  function insertMessage($poster, $string) {
    $this->load->helper('date');
    $now = local_to_gmt(time());
    $data = array(
      'user_username' => $poster,
      'text' => $string,
      'posted_at' => unix_to_human($now,TRUE,'eu')
    );
    $this->db->insert('Messages', $data);
  }

// find all of the messages from user that the logged in user follows
// return all of those messages
  function getFollowedMessages($name = null) {
    $query = $this->db->get('Messages');
    $this->db->join('User_Follows', 'User_Follows.followed_username = Messages.user_username');
    $this->db->where('User_Follows.follower_username', $name);
    $this->db->order_by('posted_at', 'desc');

    return $query->result();
  }
}
?>
