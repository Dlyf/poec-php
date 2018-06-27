<?php
  // déclaration de constantes
  define('TEMPLATES_PATH',
    'C:\xampp\htdocs\php-bases\verygoodtrip\templates');

  define('BASE_URL',
    'http://localhost/php-bases/verygoodtrip');

function db_connect() {
  try {
    $db = new PDO('mysql:host=localhost;dbname=verygoodtrip', 'root', '');
    // si succès on renvoie l'objet $db
    return $db;
  } catch(PDOException $e) {
    // si erreur on renvoie null
    return null;
  }
}
?>
