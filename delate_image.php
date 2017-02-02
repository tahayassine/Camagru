<?php
session_start();
require 'inc/class/autoloader.php';
Autoloader::register();
require("inc/class/database.php");
require("inc/class/serveur.php");
require("inc/class/image.php");
$bdd = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
if (isset($_POST['img'])/* && file_exists($_POST['img'])*/) {
  $img = trim($_POST['img']);
  $img_key = end(explode('\\',basename($img , ".png")));
  var_dump($imagelog);
  if ($img_key != ""){
    // $stest = mysql_real_escape_string($img_key);
    $imagelog = $bdd->prepare("SELECT * FROM image WHERE img_key=?", array($img_key),null,true);
    if (isset($imagelog)) {
      $rep = $bdd->prepare("DELETE FROM image WHERE img_key=?", array($img_key));
      $img = new Image($imagelog);
      if(file_exists($img->getLink())){
        unlink ($img->getLink());
        echo $img_key ;
      }
    }else {
      echo "Erreur";
    }
  }else {
    echo "Erreur";
  }
}else {
  echo "Erreur";
}
 ?>
