<?php
if (isset($_SESSION["connect"]) && isset($_SESSION["username"]) && isset($_SESSION["user_key"])){
	unset($_SESSION["connect"]);
	unset($_SESSION["user_key"]);
	unset($_SESSION["username"]);
}
header('Location: index.php');
?>
