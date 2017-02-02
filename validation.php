<?php
  session_start();
  require 'inc/class/autoloader.php';
  Autoloader::register();
  if (!isset($bdd)){
    require_once("install.php");
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camataha</title>
  </head>
  <body>
    <div class="validation"><p>
      <?php
      if (isset($_GET['user']) && isset($_GET['key']))
      {
        $userlog = $bdd->prepare("SELECT * FROM users WHERE user_key=? and user_login=?", array($_GET['key'], $_GET['user']));
        if (isset($userlog)&&$userlog != null){
          //var_dump($userlog[0]->actif);
          if ( $userlog[0]->actif === '0'){
            $bdd->prepare("UPDATE users SET actif = 1, user_key=:key WHERE user_login=:username", array('key' => $_GET['key'],'username' => $_GET['user']));
              echo "votre compte a été validé avec succès!!";
              mkdir("img/gallery/".$_GET['key']);
          }else {
            echo "votre conpte est deja Valider!";
          }
        }else{
          echo "votre conte nexiste pas.";
        }
      }else {
        echo "tu fais quoi ici?";
          }
       ?>
       <p>
         <a href="index.php">clic ici pour retourner au site</a>
    </div>
    <?php require_once "inc/footer.php" ?>

  </body>
</html>
