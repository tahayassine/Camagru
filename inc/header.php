<div id="header">
  <div class="title">
    <h1>Camataha</h1>
  </div>
  <div id="login">
  <?php
  require "inc/login.php";
  ?></div>
  <?php
  if (isset($_SESSION['connect'])) {
    require "inc/menu.php";
  }
   ?>
</div>
