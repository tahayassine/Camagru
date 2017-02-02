<?php

$mail = "tahayabis@gmail.com";
$pl = "\r\n"
if (!preg_match("#^[a-z0-9._-]+@[a-z].[a-z]{2,4}$#", $mail))
{
      $to      = $mail;
      $subject = 'le sujet';
      $message = 'Bonjour !';
      //=====Création du header de l'e-mail
      $header = "From: \"tyassine\"<tyassine@e2r7p14.42.fr>".$pl;
      $header .= "Reply-to: \"tyassine\" <tyassine@e2r7p14.42.fr>".$pl;
      $header .= "MIME-Version: 1.0".$pl;
      $header .= "Content-Type: multipart/alternative;".$pl." boundary=\"$boundary\"".$pl;
      //==========



      mail($to, $subject, $message, $headers);
      echo "envoyer!";

}

Class mail
  {

}
 ?>
