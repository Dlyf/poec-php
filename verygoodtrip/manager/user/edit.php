<?php
  include('../../dbmanager.php');
  include('../../templates/header.php');

  if (isset($_POST['submit'])) {
    // formulaire posté => écriture en BDD
    $result = updateUser($_POST['id'], $_POST);
    if ($result) {
      header('location:list.php');
    } else {
      echo '<p>Problème</p>';
    }

  } else {
    // récupération des champs actuels du voyage identifié
    // afin de préremplir le formulaire
    $user = getUsers();
    $pictures = getPicturesByTrip($_GET['id']);
    $userId = getUserById($_GET['id']);

  }

?>

<h2>Mettre à jour un utilisateur</h2>
<form action="edit.php" method="post">
  <input type="text" name="firstname" placeholder="Prénom"
    value="<?php echo $user['firstname'] ?>">
    <!-- le champ hidden permet de transmettre l'id à la
    superglobale $_POST issue de la soumission du formulaire
    -->
  <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
  <input type="submit" name="submit" value="Mettre à jour">
</form>

<?php
include('../../templates/footer.php');
?>
