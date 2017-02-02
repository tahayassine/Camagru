<?php
require("inc/class/database.php");
require("inc/class/serveur.php");

$bdd = new PDO('mysql:localhost', $DB_USER, $DB_PASSWORD);
$bdd->query('CREATE DATABASE IF NOT EXISTS db_Cama');
$bdd = null;
$bdd = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
$rep = $bdd->query("CREATE TABLE IF NOT EXISTS users
	(
		ID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
		user_login VARCHAR(255) NOT NULL,
		user_password VARCHAR(255) NOT NULL,
		user_email VARCHAR(255) NOT NULL,
		user_key varchar(32) NOT NULL,
		user_datetime DATETIME DEFAULT NOW(),
		actif int DEFAULT 0,
    admin INT DEFAULT 0,
		reini_key varchar(255)
	)");

$rep1 = $bdd->getPDO()->query("CREATE TABLE IF NOT EXISTS image
	(
		ID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
		user_key varchar(32) NOT NULL,
		img_key VARCHAR(32) NOT NULL,
		img_datetime DATETIME DEFAULT NOW(),
		public INT DEFAULT 0
		)");
$rep2 = $bdd->getPDO()->query("CREATE TABLE IF NOT EXISTS comments
	(
		ID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
		user_key varchar(32) NOT NULL,
		img_key VARCHAR(32) NOT NULL,
		com_datetime DATETIME DEFAULT NOW(),
		comment TEXT(1000)
		)");
$rep3 = $bdd->getPDO()->query("CREATE TABLE IF NOT EXISTS likes
					(
						ID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
						user_key varchar(32) NOT NULL,
						img_key VARCHAR(32) NOT NULL,
						like_datetime DATETIME DEFAULT NOW()
						)");
$username = "admin";
$password = hash('whirlpool', "admin");
$email = "taha.ma35@gmail.com";
$key = uniqid("key1");
$key2 = uniqid("key2");
$img_key = uniqid("img");
$image = imagecreatetruecolor(300,300);
$userlog = $bdd->prepare("SELECT user_login FROM users WHERE user_login=?", array($username));
if ($userlog == NULL)
{
	$root = "img/gallery/".$key;
	$root2 = "img/gallery/".$key2;
	mkdir($root);
	mkdir($root2);
	$tmp = $root."/".$img_key.".png";
	$com = "I like a blabla bicosose ise tru";
	imagepng($image, $tmp);
	$bdd->prepare("INSERT INTO users(user_login,user_password,user_email,actif,admin,user_key)
	VALUES (:username,
		:password,
		:email,
		:actif,
		:admin,
		:user_key)",
		array("username" => $username,
		"password" => $password,
		"email" => $email,
		"actif" => 1,
		"admin" => 1,
		"user_key" => $key), null);
		$bdd->prepare("INSERT INTO users(user_login,user_password,user_email,actif,admin,user_key)
		VALUES (:username,
			:password,
			:email,
			:actif,
			:admin,
			:user_key)",
			array("username" => "taha",
			"password" =>  hash('whirlpool', "taha"),
			"email" => "taha@gmail.com",
			"actif" => 1,
			"admin" => 0,
			"user_key" => $key2), null);
		$bdd->prepare("INSERT INTO image(user_key,img_key)
		VALUES (:user_key,:img_key)",
		array("user_key" => $key,"img_key" => $img_key), null);
		$bdd->prepare("INSERT INTO comments (user_key,img_key,comment)
		VALUES (
			:user_key,
			:img_key,
			:comment)",
			array(
				"user_key" => $key,
				"img_key" => $img_key,
				"comment" => $com), null);
				$bdd->prepare("INSERT INTO likes (user_key,img_key)
				VALUES (
					:user_key,
					:img_key)",
					array(
						"user_key" => $key,
						"img_key" => $img_key), null);
	}

?>
