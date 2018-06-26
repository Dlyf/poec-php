<?php
// fichier responsable du traitement du formulaire de login

// analyser $_POST
if (isset($_POST['email']) && isset($_POST['password'])) {

// récupérer le mail et le password
    try {
      // essayer d'exécuter
      // interroger la DB avec la classe PDO
      $db = new PDO('mysql:host=localhost;dbname=verygoodtrip', 'root', '');
      // echo gettype($db);
      // var_dump($db);

      // 1. préparation de la requête
      $stmt = $db->prepare(
        'SELECT * FROM user WHERE email = :email
        AND password = :password');

        // 2. Binding (associe une valeur à un placeholder)
      $stmt->bindParam(':email', $_POST['email']);
      $stmt->bindParam(':password', $_POST['password']);

      // 3. Execution de la requête
      $stmt->execute();

      // 4. Fetch (récupération des données SQL -> PHP)
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // echo sizeof($users) . ' utilisateur trouvé';

      if (sizeof($users) > 0) {
        echo 'salut cher ' .$users[0]['firstname'];
      } else {
        echo 'Utilisateur inconnu ou mot de passe erroné';
      }






    } catch(PDOException $e) {
      echo 'problème: ' .$e->getMessage();
    }

  } else {
    echo 'informations manquantes...';
  }

?>
