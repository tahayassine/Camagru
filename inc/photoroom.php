
  <?php  require "inc/filters.php" ?>
  <div class="content">
    <div class="camera">
      <video id="video">Video stream not available.</video>
      <img id="filtreactive" src="">
      <br />
      <button id="startbutton"><i class="fa fa-camera" aria-hidden="true"></i></button>
      <?php  require "inc/download_img.php" ?>
      <form class="" action="" method="post" enctype="multipart/form-data">
        <input type="file" name="img" accept="image/*"/>
        <input type="submit" name="submit"/>
      </form>
      <br />
      <div class="output">
        <img id="photo" style="" src= "<?php if(file_exists($file = "img/tmp/".$_SESSION['user_key'].".png"))echo $file ;?>">
        <img  id="filter" src="img/filter/bisous.png" onmousedown="" alt="filter" style="left:0px;top:0px;">
      </div>
      <button id="pushImg" onclick="request(addToGalrie)"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
      <canvas id="canvas" style="display:none"></canvas>
    </div>
    <?php require "inc/gallery.php" ?>
  </div>
<script src="js/oXHR.js"></script>
<script src="js/webcam.js"></script>
<script src="js/app.js"></script>
<script src="js/ajax.js"></script>
