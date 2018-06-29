<?php
require_once('dbmanager.php');
require_once('utility.php');
include('templates/header.php');


$trip = getTripById($_GET['id']);
$pictures = getPicturesByTrip($_GET['id']);

?>

<h1>Informations du voyages</h1>

<h2>Liste de voyage</h2>

<table class="table table-bordered table-striped">
  <tr>
    <th>Intitulé</th>
    <th>Destination</th>
    <th>Dates</th>
    <th>Description</th>
    <th>Prix</th>
  </tr>
    <tr>
      <td><a href="trip_detail.php?id=<?php echo $trip['id'] ?>"> <?php echo $trip['title'] ?></a></td>
      <td><?php echo $trip['country'] ?></td>
      <td><?php  echo 'Du ' . transformSQLDate($trip['date_start']);
          echo ' au ' . transformSQLDate($trip['date_end']); ?></td>
          <td>
            <?php echo $trip['description'] ?>
          </td>
          <td>
            <?php echo $trip['price'] ?> €
          </td>
    </tr>
</table>

<h2>Photos associées</h2>
<?php
  if ($pictures != null && sizeof($pictures) > 0) {
    foreach ($pictures as $picture) {
      $picture_path = BASE_URL . '/static/img/upload/' . $picture['path'];
      echo '<img class="thumb" src="'.$picture_path.'">';
    }
  } else {
    echo '<p>Aucune image associée</p>';
  }
?>
<?php
include('templates/footer.php');

?>
