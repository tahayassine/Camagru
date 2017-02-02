<?php
//header ("Content-type: image/jpeg"); // L'image que l'on va créer est un jpeg
//header("Content-Type: text/text");
// On charge d'abord les images
  session_start();
  require 'inc/class/autoloader.php';
  Autoloader::register();
  require("inc/class/database.php");
  require("inc/class/serveur.php");
  require("inc/class/image.php");
  $bdd = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);

  if (isset($_POST['x']) && isset($_POST['y']) && isset($_POST['dest'])
  && isset($_POST['src']) && $_POST['dest'] != 'null' && file_exists(trim($_POST['src'])) && (trim($_POST['dest']) != "")){
    $x = $_POST['x'];
    $y = $_POST['y'];
    $dest = trim($_POST['dest']);
    $src = trim($_POST['src']);
    $user = $_SESSION['user_key'];
    $source = imagecreatefrompng($src); // Le logo est la source
    $destination = imagecreatefrompng($dest); // La photo est la destination
    // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
    $largeur_source = imagesx($source);
    $hauteur_source = imagesy($source);
    $largeur_destination = imagesx($destination);
    $hauteur_destination = imagesy($destination);

    // On veut placer le logo en bas à droite, on calcule les coordonnées où on doit placer le logo sur la photo
    $destination_x = $largeur_destination - $largeur_source + $x;
    $destination_y =  $hauteur_destination - $hauteur_source + $y;
    imagealphablending($destination, true);
    imagesavealpha($destination, true);
    imagecopy($destination, $source, $x, $y, 0, 0, $largeur_source, $hauteur_source);
    $img_key = uniqid();
    $dir = 'img/gallery/' . $user;
    $file = $dir . '/' . $img_key .'.png';
    $arrayImg = array("user_key" => $user,
      "img_key" => $img_key);
    $imagelog = $bdd->prepare("INSERT INTO image(user_key,img_key)
      VALUES (:user_key,
              :img_key)",
        $arrayImg, null, true);
      $imagelog = new Image($arrayImg);
    imagepng($destination, $file);
    echo $imagelog->getCard();
  }else{
    echo "Erreur";
  }
?>
