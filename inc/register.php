<?php
  // require_once "inc/class/user.php";
  // require_once "inc/class/database.php";
 ?>
<label>S'enregistre:</label>
<form action="index.php?p=register" method="post">
  <input type="text" name="username" placeholder="Ex : taha35" required/>
  <input type="password" name="password" placeholder="password" required/>
  <input type="email" name="email" placeholder="Ex : taha35@gmail.com" required/>
  <input type="submit" value="S'enregister">
</form>
<?php
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
  $username = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);
  $email = htmlspecialchars($_POST["email"]);
  if (strlen($password) < 8) {
          echo "<p class=\"message_alert\">le mot de passe doit contenir aux moins 6 caractères!</p>";
    }else if (!preg_match("#[0-9]+#", $password)) {
          echo "<p class=\"message_alert\">le mot de passe doit contenir au moins une chiffre!</p>";
    }else if (!preg_match("#[a-zA-Z]+#", $password)) {
          echo "<p class=\"message_alert\">le mot de passe doit contenir au moins une letter!</p>";
    }else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    echo "<p class=\"message_alert\">Votre mail n'est pas valide.</p>";
  } else{
  $arrayUser = array('user_login' => $username,
                  'password' => hash('whirlpool', $password),
                  'user_email'=> $email,
                  'user_key' => md5(microtime(TRUE)*100000)
                );
  $userlog = $bdd->prepare("SELECT user_login FROM users WHERE user_login=?", array($_POST["username"]), "User", true);
  $emaillog = $bdd->prepare("SELECT user_email FROM users WHERE user_email=?", array($_POST["email"]), "User", true);
  if ($userlog == null && $emaillog == NULL) {
    $bdd->prepare("INSERT INTO users(user_login, user_password, user_email, user_key)
    VALUES (:user_login,
        :password,
        :user_email,
        :user_key)",
    $arrayUser, null);
    $userlog = new User($arrayUser);
    $userlog->sendMail();
    // PARAMETRE MAIL()
    $userlog = null;
    echo "<p class=\"message_alert\">votre compte a bien été enregistré. consulter votre adresse mail pour confirmer le confirmer. </p>";
    // Your account has been successfully registered. Check your email address to confirm it.

  }
  else {
    echo "<p class=\"message_alert\"> désolé ce compte existe déjà.</p>";
    // Sorry this account already exists.
  }
}
}
 ?>
