<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Formation: Bases du PHP</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/app.css">
</head>

<body>


<?php
// Variables

// types simples (primitifs, scalaires)
$message = 'Bienvenue à tous !'; // string
$age = 18; // number, integer
$weight = 80.5; // number, float
$logged = false; // boolean
$name = null; // absence de définition, de valeur
$html = '';

// types complexes (tableaux)
// tableaux simples, indexés numériques (premier indice: 0)
$months = ['Janvier', 'Février', 'Mars'];
$bazar = ['Chaîne', 99, true, null, $age, $message, $months];

//tableau associatif (clé associé à valeur)
$lloris = [
  'name' => 'Hugo Lloris',
  'number' => 1,
  'club' => 'Tottenham',
  'injured' => false
];

$matuidi = [
  'name' => 'Blaise Matuidi',
  'number' => 6,
  'club' => 'Juventus',
  'injured' => true
];

$pogba = [
  'name' => 'Paul Pogba',
  'number' => 6,
  'club' => 'Manchester',
  'injured' => false
];

echo $lloris['name'];
echo '<br>';
echo $matuidi['club'];
echo '<br>';


//un tableau contenant 2 tableaux associatif
$players = [$lloris, $matuidi, $pogba];

echo $bazar[6][2]; // output: Mars


echo '<h1>' . $message . '</h1>';
echo $age * 2;

if ($logged) {
  echo '<p>utilisateur connecté</p>';
} else  {
  echo '<p>utilisateur non connecté</p>';
}

if ($age > 17) {
  echo '<p>Tu es majeur, tant mieux</p>';
} else {
  echo '<p>Tant pis, tu ne peux accéder à ce contenu illicite</p>';
}

// boucles
// affichage d'une liste de mois

$html = '<ul>';
for ($i=0; $i<sizeof($months); $i++) {
  $html .= '<li>'. $months[$i] .'</li>';
}
$html .= '</ul>';
echo $html;
// fin du bloc php
?>

<div>
  <input id="cbInjured" type="checkbox">
  <span>Joueurs en forme</span>
</div>

<form>
  <div>
    <input id="cbInjured2" type="checkbox" >
    <span>Joueurs en forme</span>
    <input type="submit" class="btn btn-primary"  name="" value="Valider">
  </div>
</form>


<?php
// création d'un tableau de joueurs
// déclaration d'un tableau de strings via la foncrion array()
$tableHeaders = array('Nom', 'Numéro', 'Club', 'Etat de forme');
$html = '<table class="table table-bordered table-striped">';
$html .= buildTableHeader($tableHeaders);

foreach ($players as $player) {
  $html .= '<tr>';
  $html .= '<td>'.$player['name'].'</td>';
  $html .= '<td>'.$player['number'].'</td>';
  $html .= '<td>'.$player['club'].'</td>';

//équivalent en notation ternaire
$html.= ($player['injured']) ? '<td class="injured">Blessé</td>' : '<td>En pleine forme</td>';

  // if ($player['injured']) {
  //   $html .= '<td>Blessé</td>';
  // } else {
  //   $html .= '<td>En pleine forme</td>';
  // }

  $html .= '</tr>';
}
$html .= '</table>';
echo $html;

function buildTableHeader($columnHeaders) {
  $output = '<tr>';
  foreach ($columnHeaders as $header) {
    $output .= '<th>'. $header .'</th>';
  }
  $output .= '</tr>';
  return $output;
}

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>
