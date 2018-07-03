<?php

include('../../config.php');
include('../../utility.php');
include('../../templates/header.php');



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
  $db = db_connect();

  if (isset($_POST['submit'])) {
    // si le nom du pays a plus de 2 caractères
    // écriture en base de données
    if ($db) {
      //1. préparation de la requête
      $query = $db->prepare('INSERT INTO user(
        firstname,
        lastname,
        email,
        password,
        role
      ) VALUES (
        :firstname,
        :lastname,
        :email,
        :password,
        :role)
      ');

      // 2. exécution + Binding
      $result = $query->execute(array(
        ':firstname' => cleanInput($_POST['firstname']),
        ':lastname' => cleanInput($_POST['lastname']),
        ':email' => cleanInput($_POST['email']),
        ':password' => cleanInput($_POST['password']),
        ':role' => cleanInput($_POST['role'])
      ));

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
  <input type="text" name="lastname" placeholder="Nom">
  <input type="email" name="email" placeholder="Email">
  <input type="password" name="password" placeholder="Mot de passe">
  <div class="form-group">
    <select name="user">
      <option value="0">Sélectionner un rôle</option>
      <?php if ($users): ?>
        <?php foreach($users as $user): ?>
          <option value="<?php echo $user['id']?>">
            <?php echo $user['role'] ?>
          </option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
  <input type="submit" name="submit" value="Enregistrer">

</form>

<?php
include('../../templates/footer.php');
?>
