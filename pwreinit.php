<?php
  session_start();
  require 'inc/class/autoloader.php';
  Autoloader::register();
  if (!isset($bdd)){
    require_once("install.php");
  }
  require "inc/class/user.php";
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
  </head>
  <body>
    <div class="pwreinit"><p>
      <?php
      if (isset($_GET['user']) && isset($_GET['key'])){
        if (($userlog = $bdd->prepare("SELECT * FROM users WHERE reini_key=? and user_login=?", array($_GET['key'], $_GET['user']),null,TRUE)) != null) {
          if (isset($_POST['submit']) && isset($_POST['nwpassword']) && isset($_POST['confnwpassword'])) {
            if($_POST['nwpassword'] === $_POST['confnwpassword']){
              if (strlen($_POST['nwpassword']) >= 6) {
                $bdd->prepare("UPDATE users SET reini_key = null, user_password =:user_password
                  WHERE user_login=:username",
                  array('user_password' => hash('whirlpool', $_POST['nwpassword']),
                        'username' => $_GET['user']));
                  echo "<p><strong>Votre mot de passe a été modifié !</strong></p>
              		<p>Vous allez être redirigé dans 5 secondes	</p>
              		<p>Si la page ne se rafraichit pas automatiquement, <a href=\"index.php\">cliquez ici.</a></p>
              	</div>";
                return;
              }else {
                echo "le mot de passe doit contenir aux moins 6 caractères";
              }
            }else {
              echo "mot de passe de confirmation ne corespond pas!";
            }
          }
          ?><label> renisialiser votre mot de passe:</label>
          <form class="form" action="" method="post">
            <p>Nouveau mot de passe :<input type="password" name="nwpassword" value="" required="password"></p>
            <p>Confirmer votre nouveau mot de passe :<input type="password" name="confnwpassword" value="" required="password"></p>
            <input type="submit" name="submit" value="envoyer">
          </form><?php

      }else{
          echo "votre conte nexiste pas.";
        }

        ?>
         <a href="index.php">clic ici pour retourner au site</a>
    </div>
    <?php require_once "inc/footer.php"; }?>
  </body>
</html>
