<div class="gallery">
    <?php
    require_once("inc/class/image.php");
    (array) $imglog = $bdd->prepare("SELECT * FROM image ORDER BY img_datetime DESC", null,"",false);
    $userlog = $bdd->prepare("SELECT * FROM users WHERE user_key=?", array($_SESSION['user_key']),null,true);
    $nbrimg = count($imglog);
    $nbrpage = (int)($nbrimg / 10) + ((($nbrimg % 10) > 0)? 1: 0);
    $page = isset($_GET['page'])? $_GET['page'] : 1;
    $user = new User($userlog);
    foreach($imglog as $key => $image)
    {
        if ($key >= 10 * $page) {
          break;
        }
        if ($key >= ((10 * $page)-10)) {
          $image = new Image($image);
          echo "<div class=\"image\">
          ".$image->getCardPublic($user, $bdd)."
          </div>";
        }
        // var_dump($key);
    }
   ?>
  </div>
<ul class="pagination">
  <?php
  ?>
  <li><a href="<?php echo "?p=gallery&page=".($page - 1); ?>">«</a></li>
  <?php for ($i=1;$i<=$nbrpage;$i++)
      {
        if ($i == $page) {
          echo "<li><a class=\"active\" href=\"#\">$i</a></li>";
        }else {
          echo "<li><a href=\"?p=gallery&page=".$i."\">".$i."</a></li>";
        }
      }
   ?>
  <li><a href="<?php echo "?p=gallery&page=".($page + 1); ?>">»</a></li>
</ul>
<script src="js/oXHR.js"></script>
<!-- <script src="js/app.js"></script> -->
<script src="js/ajax.js"></script>
