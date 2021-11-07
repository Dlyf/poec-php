<?php
  // déclaration de constantes
  define('TEMPLATES_PATH',
    'C:\xampp\htdocs\poec-php\verygoodtrip\templates');

  define('BASE_URL',
    'http://localhost/poec-php/verygoodtrip');

function db_connect() {
  try {
    $db = new PDO('mysql:host=localhost;dbname=verygoodtrip', 'root', '');
    $db->exec('SET NAMES utf8'); // paramètre assure l'encodage UTF8 des données transmises par  
    //$db->exec('SET NAMES utf8');
   // si succès on renvoie l'objet $db
    return $db;
  } catch(PDOException $e) {
    // si erreur on renvoie null
    return null;
  }
}
?>
