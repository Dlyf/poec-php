<?php

include('../../config.php');
include('../../utility.php');
include('../../templates/header.php');

$db = db_connect();

// $s = "<script>alert('ok')</script>";
// //echo $s;
// echo cleanInput($s);
// test
// $s ="<p>Belgique</p>";
// var_dump($s);
// var_dump(cleanInput($s));
if (isset($_POST['submit'])) {

  // nettoyage des inputs
  $cleaned_name = cleanInput($_POST['firstname']);

  if (strlen($cleaned_name) >2) {
    // si le nom du pays a plus de 2 caractères
    // écriture en base de données
    if ($db) {
      //1. préparation de la requête
      $query = $db->prepare('INSERT INTO user (firstname) VALUES (:firstname)');

      // 2. exécution + Binding
      $result = $query->execute(array(':firstname' => $cleaned_name));

      if ($result) {
        header('location:list.php');
      } else {
        echo '<p class="danger">La tentative d\'ajout a échoué</p>';
      }
    }
  }
}
?>

<h2>Ajouter un utilisateur</h2>

<form action="add.php" method="post">
  <!-- // non sécurisé : <input type="text" name="name" placeholder="Nom"> -->
  <input type="text" name="firstname" placeholder="Prénom">
  <input type="submit" name="submit" value="Enregistrer">

</form>

<?php
include('../../templates/footer.php');
?>
