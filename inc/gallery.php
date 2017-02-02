<div class="gallery">
    <?php
    require_once("inc/class/image.php");
    (array) $imglog = $bdd->prepare("SELECT * FROM image WHERE user_key=?", array($_SESSION['user_key']),"",false);
    foreach($imglog as $image)
    {
        $image = new Image($image);
        echo "<div class=\"image\">
          ".$image->getCard()."
          </div>";
    }
   ?>
  </div>
