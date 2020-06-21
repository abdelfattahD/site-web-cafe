
<?php session_start() ?>

<?php 
    $_SESSION['idAdmin'] = null;
  

    header('Location: admLogin.php');
?>