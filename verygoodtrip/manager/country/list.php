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
    // var_dump($countries);
  }
}
?>

<h2>Liste des pays</h2>
<a class="btn btn-primary btn-sm" href="add.php">Ajouter un pays</a>

<table class="table table-bordered table-striped">
  <tr>
    <th>Nom</th>
    <th>Actions</th>
  </tr>

  <?php foreach($countries as $country): ?>
    <tr>
      <td><?php echo $country['name'] ?></td>
      <td>
        <a class="btn btn-primary btn-sm" href="edit.php">Editer</a>
        <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo  $country['id'] ?>">Supprimer</a>
      </td>
    </tr>

  <?php endforeach ?>
</table>
<?php include('../../templates/footer.php'); ?>
