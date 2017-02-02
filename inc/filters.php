<div class="filters">
  <li id="">
    <?php
    $dir = 'img/filter/*.png';
    $files = glob($dir,GLOB_BRACE);
    foreach($files as $image)
    {
      echo "<lu><img onclick=\"changeFilter(this)\" src=\"  ".$image."\" alt=\"\"></lu>";
    }
     ?>
   </li>
</div>
