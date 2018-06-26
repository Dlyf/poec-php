<?php
$images = array(
  ["title" => "Dauphin", "file" => "Delfino.jpg"],
  ["title" => "Loup", "file" => "loup.jpg"],
  ["title" => "Taureau", "file" => "toro.jpg"]
);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="" method="get">
      <select name="selectedImage">
        <?php
          foreach ($images as $image) {
            echo '<option value="'.$image['file'].'">'.$image['title'].'</option>';
          }
        ?>
      </select>
      <input type="submit" name="submit" value="Valider">
    </form>

    <div>
      <?php
        if (isset($_GET['submit'])) {
          $file = 'img/' . $_GET['selectedImage'];
          echo '<img src="'.$file.'">';
        }
      ?>
    </div>
  </body>
</html>
