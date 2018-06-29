<?php
require_once('../../dbmanager.php');
include('../../templates/header.php');

// récupération des utilisateurs
$users = getUsers();  
?>

<h2>Liste des utilisateurs</h2>

<table class="table table-bordered table-striped">
  <tr>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Email</th>
    <th>Mot de pass</th>
    <th>Role</th>
  </tr>

  <?php foreach($users as $user): ?>
    <tr>
      <td><?php echo $user['firstname'] ?></td>
      <td><?php echo $user['lastname'] ?></td>
      <td><?php echo $user['email'] ?></td>
      <td><?php echo $user['password'] ?></td>
      <td><?php echo $user['role'] ?></td>
    </tr>
  <?php endforeach ?>

</table>
  <?php
  include('../../templates/footer.php');

  ?>
