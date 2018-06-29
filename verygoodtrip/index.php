<?php
require_once('dbmanager.php');
include(TEMPLATES_PATH . '\header.php');

$countries = getCountries();

if (isset($_GET['submit'])) {
  // le client a cliqué sur le bouton Rechercher
  // $trips = searchTrip(null);
  $criteria = array('country' => $_GET['country']);
  $trips = searchTrip($criteria);
  var_dump($trips);
}
?>

<h1>Very Good Trip</h1>
<form method="get">
  <select name="country">
    <option value="0">Choisir une destination</option>
    <?php
      foreach ($countries as $country) {
        echo '<option value="'.$country['id'].'">'
        .$country['name'].'</option>';
      }
    ?>

  </select>
  <span>Entre le</span><input type="date" name="date_start">
  <span>et le </span><input type="date" name="date_end">
  <input type="text" name="price" placeholder="Prix maximal">
  <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Rechercher">
</form>
<?php include('templates/footer.php'); ?>
