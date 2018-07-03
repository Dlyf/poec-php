<?php
  // include('../../dbmanager.php');
  include('../../config.php');
  include('../../utility.php');
  include('../../dbmanager.php');
  include('../../templates/header.php');
  $db = db_connect();

  // initialisation d'un tableau vide (pas obligatoire)


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
    $users = getUsers();
    $user = getUserById($_GET['id']);

  }
     //var_dump($user['firstname']);
?>

<h2>Mettre à jour un utilisateur</h2>

<form action="edit.php" method="post">
  <input type="hidden" name="id"
    value="<?php echo $_GET['id'] ?>">
  <input type="text" name="firstname" placeholder="Prénom"
    value="<?php echo $user['firstname'] ?>">
  <input type="text" name="lastname" placeholder="Nom"
  value="<?php echo $user['lastname'] ?>">
  <input type="text" name="email" placeholder="Email"
    value="<?php echo $user['email'] ?>">
  <input type="text" name="password" placeholder="Mot de passe"
    value="<?php echo $user['password'] ?>">
  <select name="user">
    <option value="0">Sélectionner un rôle</option>
    <option value="<?php echo $user['role'] ?>"><?php echo $user['role'] ?></option>

  </select>
  </select>


    <!-- le champ hidden permet de transmettre l'id à la
    superglobale $_POST issue de la soumission du formulaire
    -->
  <input type="submit" name="submit" value="Mettre à jour">
</form>

<?php
include('../../templates/footer.php');
?>
