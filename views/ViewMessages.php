<!DOCTYPE html>
<html>
<body>

  <?php include 'Header.php'; ?>
  <?php
// if the user is not null and the like is not null
// the display the user, the feed link and the follow link
  if ($user != null && $link != null) {
    echo $user;
    echo $link;

    echo $follow;
  }

    $this->load->helper('url');
// if there are no meesage then display an error message
// else display all of the messages
    if ($messages == null) {
    echo "There are no messages";
    }
    else {
      foreach ($messages as $message)
      {
        echo "<div id=user>";
        echo anchor(site_url('user/view/'.$message->user_username), $message->user_username);
        echo "<div id = time>";
        echo $message->posted_at;
        echo "<div id = text>";
        echo $message->text;
        echo "</div></div></div>";
      }
    }
  ?>
  </div>
</body>
</html>
