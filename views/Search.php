<head>
</head>

<html>
<body>
<?php include 'Header.php'; ?>
<div>
  <form action="<?php echo site_url('search/dosearch');?>" method="get">
    Search: <input type = "text" name = "search" required><br>
    <input type="submit">
  </form>
</div>
</body>
</html>
