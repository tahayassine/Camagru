<?php

  if (isset($_POST['submit'])) {
    $img = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    if (!empty($img_tmp)){
      $image = explode('.', $img);
      $image_ext = end($image);
      if (in_array(strtolower($image_ext),array('png','jpg','jpeg')) === false) {
        echo "fichier autorise: png ,jpg et jpeg";
      }else {
        $image_size = getimagesize($img_tmp);
        if ($image_size['mime'] == 'image/jpeg') {
          $image_src = imagecreatefromjpeg($img_tmp);
        }else if ($image_size['mime'] == 'image/png') {
          $image_src = imagecreatefrompng($img_tmp);
        }else {
          $image_src = false;
          echo "Image non valide";
        }
        if ($image_src != false ) {
          $image_width = 500;
          if($image_size[0] == $image_width){
            $image_finale = $image_src;
          }else{
            $new_width[0] = $image_width;
            $new_height[1] = 375;
            $image_finale = imagecreatetruecolor($new_width[0],$new_height[1]);
            var_dump($image_src);
            imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width[0],$new_height[1],$image_size[0],$image_size[1]);
          }
          $file = "img/tmp/".$_SESSION['user_key'].".png";
          if(file_exists($file)){
            unlink($file);
          }
          //var_dump($file);
          ini_set('memory_limit', '-1');
          imagepng($image_finale, $file);
        }
      }
    }else {
      echo "Veuillew rentrer une image";
    }
  }
 ?>
