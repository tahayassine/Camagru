<?php
$username = $_POST["username"];
$userlog = $bdd->prepare("SELECT * FROM users WHERE user_login LIKE ?", array($username), null, true);
if ($userlog != null)
{
  $userlog = new User($userlog);
  $password = hash('whirlpool', $_POST["password"]);
  if ($userlog->getUserPass() === $password)
  {
    if ($userlog->isUserActif())
    {
      $_SESSION["connect"] = true;
      $_SESSION["username"] = $username;
      $_SESSION["user_key"] = $userlog->getUserKey();
      // header('Location: index.php');
    }else{
      echo "Votre compte n'est pas encore activé";
    }
  }else{
    echo "mauvais mot de passe";
  }
}else{
  echo "Tu ne t'es pas enregistre ou mauvais mot de passe / username.";
}
 ?>
