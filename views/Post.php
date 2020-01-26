<html>
<body>
  <?php include 'Header.php'; ?>
   <h1>Post Message</h1>

  </textarea>
  <form action="<?php echo site_url('Message/doPost');?>"method="post"><br>
  Message: <input type = "text" name = "post" required><br>
  <input type="submit">
  </form>
</div>
</body>
</html>
