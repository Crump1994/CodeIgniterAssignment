<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheet.css'); ?>">
<link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
</head>
<body>

  <?php
// if the user is logged in then fill the nav bar
// else display a link to the login page
  if (isset($_SESSION['user'])) {
    echo "<ul>";
    echo "<li><a href=".site_url('Message/index').">Post Message</a></li>";
    echo "<li><a href=".site_url('User/feed/'.$_SESSION['user']).">My Feed</a></li>";
    echo "<li><a href=".site_url('User/view/'.$_SESSION['user']).">My Messages</a></li>";
    echo "<li><a href=".site_url('Search/index/'.$_SESSION['user']).">Search Messages</a></li>";
    echo "<li style=float:right><a href=".site_url('User/logout').">Logout</a></li>";
    echo "<li style=float:right><p>Logged in as ".$_SESSION ['user']."<p></li>";
    echo "</ul>";
  }
  else {
    echo "<ul><li style=float:right><a href=".site_url('User/login').">Login</a></li></ul>";
  }

   ?>
   <div id = "body">
</body>
