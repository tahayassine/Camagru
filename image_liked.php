<?php
session_start();
require 'inc/class/autoloader.php';
Autoloader::register();
require("inc/class/database.php");
require("inc/class/serveur.php");
require("inc/class/image.php");
$bdd = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
  if (isset($_POST['img']) && isset($_SESSION['user_key'])) {
    $img = trim($_POST['img']);
    $user_key =  $_SESSION['user_key'];
    $imglog = $bdd->prepare("SELECT * FROM likes WHERE img_key=? and user_key=?", array($img, $user_key));
    if (!$imglog) {
      $bdd->prepare("INSERT INTO likes(img_key,user_key)
      VALUES(:img_key,:user_key)",
      array("img_key" => $img, "user_key" =>$user_key), null);
      echo "<i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i>";
    }else {
      $bdd->prepare("DELETE FROM likes WHERE img_key=? and user_key=?", array($img, $user_key));
      echo "<i class=\"fa fa-heart\" aria-hidden=\"true\"></i>";
    }
  }
 ?>
