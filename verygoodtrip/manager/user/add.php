<?php
include_once('../../config.php');
include('../../utility.php');
include('../../templates/header.php');
include('../../dbmanager.php');

$users = getUsers();


if (isset($_POST['submit'])) {
  // nettoyage des inputs
  $cleaned_name = cleanInput($_POST['name']);
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'INSERT INTO user (
        firstname,
        lastname,
        email,
        password,
        role)

        VALUES(
          :firstname,
          :lastname,
          :email,
          :password,
          :role
        )
      ');
    $result = $query->execute(array(
      ':firstname' => cleanedInput($_POST['firstname']),
      ':lastname' => cleanedInput($_POST['lastname']),
      ':email' => cleanedInput($_POST['email']),
      ':password' => cleanedInput($_POST['password']),
      ':role' => cleanInput($_POST['role'])
    ));
    if ($result) {
      header('location:list.php');
    }
  }
}
?>
<h2>Ajouter un utilisateur</h2>

<form action="add.php" method="post">
  <div class="form-row">
    <div class="col">
      <input type="text" class="form-control" placeholder="First name"><br>
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Last name">
    </div>
  </div>
  <div class="form-group">
    <input type="email" name="email" placeholder="Email">
  </div>
  <div class="form-group">
    <input type="password" name="password" placeholder="Password">
  </div>
  <div class="form-group">
    <input type="password" name="password" placeholder="Password">
  </div>

  <div class="form-group">
    <select name="country">
      <option value="0">Sélectionner un rôle</option>
      <option value="Client">Client
      <option value="Admin">Admin

    </select>
  <input type="submit" name="submit" value="Enregistrer">
</form>

<?php
  include('../../templates/footer.php');
?>
