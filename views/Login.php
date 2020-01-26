<html>
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheet.css'); ?>">
</head>

<body>
  <ul>
  <form id="login" action="<?php echo site_url('User/doLogin');?>" method="post">
    Username: <input type = "text" name = "username" required>
    Password: <input type = "text" name = "password" required>
    <input type="submit">
  </form>
</body>
</html>
