<?php
require_once('config.php');

// table: country
function getCountries() {
  $db = db_connect();
  $countries = null;
  if ($db) {
    $query = $db->prepare(
      'SELECT * FROM country ORDER BY name ASC');
    $result = $query->execute();
    if ($result) {
      $countries = $query->fetchAll(PDO::FETCH_ASSOC);
      return $countries;
    }
  }
  return $countries;
}

// table: trip
function getTrips($full = true) {
  $db = db_connect();
  $trips = null;
  if ($db) {
    if ($full) {
      $query = $db->prepare(
        'SELECT * FROM trip ORDER BY date_start DESC');
    } else {
      // si le paramètre $full vaut false, on ne prend
      // qu'une partie des colonnes
      $query = $db->prepare(
        'SELECT trip.id, title, country, date_start, date_end, name AS country_name
          FROM trip
          LEFT JOIN country ON trip.country = country.id
          ORDER BY date_start DESC');
    }

    $result = $query->execute();
    if ($result) {
      $trips = $query->fetchAll(PDO::FETCH_ASSOC);
      return $trips;
    }
  }
  return $trips;
}

function getTripById($id) {
  $db = db_connect();
  if($db) {
    $query = $db->prepare(
      'SELECT * FROM trip WHERE id = :id');
    $result = $query->execute(array(':id' => $id));
    if ($result) {
      return $query->fetch(PDO::FETCH_ASSOC);
    }
  }
  return null;
}

function updateTrip($id, $data) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'UPDATE trip
          SET country     = :country,
              date_start  = :date_start,
              date_end    = :date_end,
              title       = :title,
              description = :description,
              price       = :price
        WHERE id          = :id
      ');
    $result = $query->execute(array(
      ':id'           => $id,
      ':country'      => $data['country'],
      ':date_start'   => $data['date_start'],
      ':date_end'     => $data['date_end'],
      ':title'        => $data['title'],
      ':description'  => $data['description'],
      ':price'        => $data['price']
    ));
    return $result;
  }
  return null;
}

function deleteTrip($id) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare('DELETE FROM trip WHERE id = :id');
    $result = $query->execute(array(':id' => $id));
    return $result;
  }
  return null;
}

// tabme: picture
function insertPicture($trip_id, $path) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'INSERT INTO picture (trip_id, path)
        VALUES(:trip_id, :path)
        ');
    $result = $query->execute(array(
      ':trip_id' => $trip_id,
      ':path' => $path
    ));
    return $result;
  }
  return null;
}

function getPicturesByTrip($trip_id) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'SELECT * FROM picture WHERE trip_id = :trip_id');
    $result = $query->execute(array(':trip_id' => $trip_id));
    if ($result) {
      // formater les résultats du tablea en un tableau associatif
      return $query->fetchALL(PDO::FETCH_ASSOC);
    }
  }

}
?>
