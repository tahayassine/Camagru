<?php

class User
{
	private $id = null;
	private $user_login = null;
	private $user_password = null;
	private $user_email = null;
	private $user_key = null;
	private $actif = null;
	private $admin = null;
	private $reini_key = null;
	private $user_datetime = null;

	public function __construct($kwargs)
	{
		$this->id = isset($kwargs['id'])? $kwargs['id']: null;
		$this->user_login = isset($kwargs['user_login'])? $kwargs['user_login']: null;
		$this->user_password = isset($kwargs['user_password'])? $kwargs['user_password'] : null;
		$this->user_email = isset($kwargs['user_email'])? $kwargs['user_email'] : null;
		$this->user_key = isset($kwargs['user_key']) ? $kwargs['user_key'] : null;
		$this->actif = isset($kwargs['actif']) ? $kwargs['actif'] : null;
		$this->admin = isset($kwargs['admin']) ? $kwargs['admin'] : null;
		$this->reini_key = isset($kwargs['reini_key']) ? $kwargs['reini_key'] : null;
		$this->user_datetime = isset($kwargs['user_datetime']) ? $kwargs['user_datetime'] : null;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getUserName()
	{
		return $this->user_login;
	}

	public function getUserPass()
	{
		return $this->user_password;
	}

	public function getUserMail()
	{
		return $this->user_email;
	}

	public function getUserKey()
	{
		return $this->user_key;
	}

	public function isUserActif()
	{
		return $this->actif;
	}

	public function getReiniKey()
	{
		return $this->reini_key;
	}

	public function getDatetime()
	{
		return $this->user_datetime;
	}

	public function sendMail()
	{
		$pl = "\r\n";
		$subject = 'Activation de votre compte Camagru';
		$message = 'Bienvenue sur Camagru,' . $pl . 'Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet.'
 					. $pl . $pl . 'http://localhost:8080/Camataha/validation.php?user=' . urlencode($this->user_login) . '&key=' . urlencode($this->user_key) . $pl . $pl
					. '---------------' . "\r\n" . 'Ceci est un mail automatique, Merci de ne pas y répondre.';
		$header = "From: \"tyassine\"<tyassine@e2r7p14.42.fr>".$pl;
		$header .= "Reply-to: \"tyassine\" <tyassine@e2r7p14.42.fr>".$pl;
		$header .= "MIME-Version: 1.0".$pl;
		$header .= "Content-Type: text/plain".$pl;
		mail($this->user_email, $subject, $message, $headers);
	}

	public function sendResetMail()
	{
		$subject = 'Réinitialisation de votre mot de passe pour votre compte Camagru';
		$message = '
		<html>
		<head>
		<title>Réinitialisation de cotre mot de passe</title>
		</head>
		<body>
			<p>Bonjour ' . $this->user_login . ',</p>
			<br />
			<p>Quelqu’un a récemment demandé à réinitialiser votre mot de passe Camagru.</p>
			<a href="http://localhost:8080/Camataha/pwreinit.php?user=' . urlencode($this->user_login) . '&key=' . urlencode($this->reini_key) . '">Cliquez ici pour changer votre mot de passe.</a>
			<br />
			<p>---------------</p>
			<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>
		</body>
		</html>
		';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: tyassine@student.42.fr' . "\r\n";
		mail($this->user_email, $subject, $message, $headers);
	}

	public function sendComMail($com)
	{
		$subject = 'vous avez ressus un nouveau commentaire';
		$message = '
		<html>
		<head>
		<title>Quelqu’un a récemment commentez une de vos photos</title>
		</head>
		<body>
			<p>Bonjour ' . $this->user_login . ',</p>
			<br />
			<p>Quelqu’un a récemment commentez une de vos photos.</p>
			<a href="http://localhost:8080/Camataha/index.php">Cliquez ici pour visiter votre conpte et voir les nouvelles</a>
			<br />
			<p>---------------</p>
			<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>
		</body>
		</html>
		';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: tyassine@student.42.fr' . "\r\n";
		mail($this->user_email, $subject, $message, $headers);
	}
}
?>
