<?php
require_once('../../dbmanager.php');
include('../../templates/header.php');

// récupération des utilisateurs
$users = getUsers($full = false);


//var_dump($users);
?>

<h2>Liste des utilisateurs</h2>
<a class="btn btn-primary btn-sm" href="add.php">Ajouter un utilisateur</a>
<table class="table table-bordered table-striped">
  <tr>
    <th>Prénom</th>
    <th>Nom</th>
    <th>Email</th>
    <th>Mot de passe</th>
    <th>Roles</th>
    <th>Actions</th>
  </tr>
  <?php foreach($users as $user):
    var_dump($user['email']); ?>

    <tr>
      <td><?php echo $user['firstname'] ?></td>
      <td><?php echo $user['lastname'] ?></td>
      <td><?php echo $user['email'] ?></td>
      <td><?php echo $user['password'] ?></td>
      <td><?php echo $user['role'] ?></td>
      <td>
        <a
          class="btn btn-primary btn-sm"
          href="edit.php?id=<?php echo $user['id'] ?>">Editer</a>
        <a
          class="btn btn-danger btn-sm"
          href="delete.php?id=<?php echo $user['id'] ?>">Supprimer</a>
      </td>
    </tr>
  <?php endforeach; ?>

</table>
  <?php
  include('../../templates/footer.php');

  ?>
