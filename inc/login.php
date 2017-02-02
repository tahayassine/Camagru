<?php
    require "inc/class/User.php";
    // if (isset($_GET['p']) && $_GET['p'] == 'logout') {
    //   require "inc/logout.php";
    // }
    if (isset($_POST["username"]) && isset($_POST["password"]))
  {
    require("inc/to_login.php");
  }
    if (isset($_SESSION['connect']) && isset($_SESSION['username'])) {
      ?>
      <p>hello <?php echo $_SESSION['username'] ?>!</p>
      <a href="?p=logout">Se deconecter</a>
      <?php
      }
    else{
       if (isset($_GET['p']) && $_GET['p'] == "pwforgot") {
        if (isset($_POST) && isset($_POST['mail'])){
          $userlog = $bdd->prepare("SELECT * FROM users WHERE user_email=?", array($_POST["mail"]), "User", true);
          if ($userlog != null) {
            $userlog['reini_key']= md5(microtime(TRUE)*100000);
            $bdd->prepare("UPDATE users SET reini_key =:reini_key WHERE user_email =:user_email", array(
              'reini_key' => $userlog['reini_key'],
              'user_email' => $_POST["mail"]
            ), null);
            $nwUser = new User($userlog);
            $nwUser->sendResetMail();
            echo " <p> Un mail vous a ete envoyé pour réinitialiser votre mot de passe. </p>";
          }else{
            echo "<p>Mail incorecte!</p>";
          }
        }
        ?>
        <label>Votre mail:</label>
        <form class="connection" action="" method="post">
          <input type="mail" name="mail" placeholder="tymo@mail.com" required/>
          <input type="submit" value="Envoyer">
        </form>
        <a href="index.php">connection</a>
        <?php
      }else {

      ?>
      <label>Connection a votre conte:</label>
      <form class="connection" action="" method="post">
        <input type="text" name="username" placeholder="Ex : taha35" required/>
        <input type="password" name="password" placeholder="password" required/>
        <input type="submit" value="Se connecter">
      </form>
      <a href="index.php?p=pwforgot">Mot de passe oublié ?</a>
    <?php }}
?>
