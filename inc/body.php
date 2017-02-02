<div id="body">
  <?php
  if (isset($_SESSION['connect'])) {

    if (isset($_GET['p']) && $_GET['p'] == "profil") {
      require "profil.php";
    }
    else if (isset($_GET['p']) && $_GET['p'] == "gallery") {
      require "gallery_public.php";
      // gallerie gallery
    }
    else {
      require "photoroom.php";
    }
  }
  else{
    require "not_connect.php";
  }
   ?>
</div>
