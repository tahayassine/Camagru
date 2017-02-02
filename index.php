<?php
  session_start();
  require 'inc/class/autoloader.php';
  Autoloader::register();
  if (!isset($bdd)){
    require_once("install.php");
  }
  if (isset($_GET['p']) && $_GET['p']== "logout" && isset($_SESSION['connect'])) {
    require("inc/logout.php");
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="stylesheet" href="css/style.css">
    <title>Camataha</title>
  </head>
  <body>
    <?php
      require_once "inc/header.php";
      require_once "inc/body.php";
      require_once "inc/footer.php";
     ?>
  </body>
</html>
