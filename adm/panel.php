
<?php include "../db.php"; ?>
<?php ob_start();?>

<?php


session_start();
if (isset($_SESSION['idAdmin'])) {
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link href="../css/panel.css" rel="stylesheet">
</head>
<body>
  <header role="banner">
    <h1>Admin Panel</h1>
    <ul class="utilities">
      <br>
      <li class="users"><a href="#">My Account</a></li>
      <li class="logout warn"><a href="adminLogout.php">Log Out</a></li>
    </ul>
  </header>
  
  <nav role='navigation'>
    <ul class="main">
      <li class="dashboard"><a href="admindashboard">Dashboard</a></li>
      <li class="Products"><a href="product_panel.php">Products</a></li>
      <li class="add_Products"><a href="add_prod.php">add Products</a></li>
      <li class="cart"><a href="#">cart</a></li>
      <li class="users"><a href="panel_users.php">Manage Users</a></li>
    </ul>
  </nav>
  
  
  
</body>
</html>

<?php

}
else {
    header("location:admLogin.php");
}

?>