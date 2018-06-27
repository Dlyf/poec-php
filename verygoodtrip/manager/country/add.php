<?php

include('../../config.php');
include('../../templates/header.php');

$db = db_connect();
var_dump($db);

?>

<h2>Ajouter un pays</h2>

<form action="add.php" method="post">
  <input type="text" name="name" placeholder="Nom">
  <input type="submit" name="submit" value="Enregistrer">

</form>

<?php include('../../templates/footer.php');

// traitement du formulaire
if (isset($_POST['submit'])) {
  if (strlen($_POST['name']) >2) {
    // si le nom du pays a plus de 2 caractères
    // écriture en base de données
    if ($db) {
      //1. préparation de la requête
      $query = $db->prepare('INSERT INTO country (name) VALUES (:name)');

      // 2. exécution + Binding
      $result = $query->execute(array(':name' => $_POST['name']));

      if ($result) {
        header('location:list.php');
      } else {
        echo '<p class="danger">La tentative d\'ajout a échoué</p>';
      }
    }
  }
}
?>
