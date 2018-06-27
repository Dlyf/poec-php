<?php
// Remonte de 2 niveaux pour accéder au fichier
// amélioration possible: déterminer
// dynamiquement le chemin du fichier
include('../../config.php');
include('../../templates/header.php');


// récupération des pays
$db = db_connect();
if ($db) {
  $query = $db->prepare('SELECT * FROM country');
  $result = $query->execute();
  if ($result) {
    $countries = $query->fetchAll(PDO::FETCH_ASSOC);
    var_dump($countries);
  }
}
?>

<h2>Liste des pays</h2>
<a class="btn btn-primary btn-sm" href="add.php">Ajouter un pays</a>

<?php include('../../templates/footer.php'); ?>
