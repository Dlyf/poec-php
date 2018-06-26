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
        // echo 'salut cher ' .$users[0]['firstname'];

        // IMPORTANT: il faut mémoiriser l'état "identifié"
        // de l'utilisateur avant la redirection
        // sinon "on perd" le travail effectué précédemment
        // dû au fait que le protocole HTTP est stateless (amnésique)
        // il exoste plusieurs solutions à ce problème comme par exemple
        // base de données, fichier texte, session...


        // Utilisation de la session
        session_start(); // fonction ouvrant ou reprenant la session
        $_SESSION['user'] = $users[0]; //stockage de l'utilisateur connecté dans la session





        // redirection vers la page d'accueil
        header('location:index.php');

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
