<?php
//traitement du formulaire ohoto
include('../../dbmanager.php');

// var_dump($_POST);
// echo '<br><br><br>';
// var_dump($_FILES);
// echo '<br><br><br>';
// echo $_SERVER['DOCUMENT_ROOT'];

// déplacement du fichier temporaire
// vers son emplacement choisi

if ($_FILES['picture']['size'] > 70000) {
  echo '<p>fichier trop lourd</p>';
} else {
  $from = $_FILES['picture']['tmp_name'];
  $to =  $_SERVER['DOCUMENT_ROOT']
    . '/php-bases/verygoodtrip/static/img/upload/' . $_FILES['picture']['name'];


  $result = move_uploaded_file($from, $to);
  if ($result) {
    echo '<p>Fichier téléchargé avec succès</p>';
    // enregistrement en BDD
    if (insertPicture(
      $_POST['trip_id'],
      $_FILES['picture']['name'])
    ) {
      echo '<p>Enregistrement en DB OK</p>';
      header('location:edit.php?id=' . $_POST['trip_id']);
    }
  }

}
?>
