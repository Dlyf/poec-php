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

function searchTrip($criteria) {
  $db = db_connect();
  if ($db) {
    $sql = 'SELECT trip.id, country, title,
      date_start, date_end, price, name AS country_name
      FROM trip
      LEFT JOIN country ON trip.country = country.id
      WHERE trip.id > 0';

    if ($criteria['country'] != null) {
      $sql .= ' AND country = ' . $criteria['country'];
    }

    if ($criteria['date_start'] != null) {
      // echo '<p>DATE OK</p>';
      // SQL exige la présence de single cote autour de la date
      // 2018-08-24   => MAUVAIS
      // '2018-08-24' => OK
      $sql .= ' AND date_start >= ' . '\'' . $criteria['date_start'] .'\'';
    }

    if ($criteria['date_end'] != null) {
      // echo '<p>DATE OK</p>';
      // SQL exige la présence de single cote autour de la date
      // 2018-08-24   => MAUVAIS
      // '2018-08-24' => OK
      $sql .= ' AND date_end <= ' . '\'' . $criteria['date_end'] .'\'';
    }

    if ($criteria['price'] != null) {
      $sql .= ' AND price < ' . $criteria['price'];
    }

    $query  = $db->prepare($sql);
    $result = $query->execute();
    if ($result) {
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }
  }
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

// table : utilisateurs
function getUsers() {
  $db = db_connect();
  $users = null;
  if ($db) {
    $query = $db->prepare(
      'SELECT * FROM user ORDER BY firstname, lastname ASC');
    $result = $query->execute();
    if ($result) {
      $users = $query->fetchAll(PDO::FETCH_ASSOC);
      return $users;
    }
  }
  return $users;
}

function getUserById($id) {
  $db = db_connect();
  if($db) {
    $query = $db->prepare(
      'SELECT * FROM user WHERE id = :id');
    $result = $query->execute(array(':id' => $id));
    if ($result) {
      return $query->fetch(PDO::FETCH_ASSOC);
    }
  }
  return null;
}

function updateUser($id, $data) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'UPDATE user
          SET firstname   = :firstname,
              lastname    = :lastname,
              email       = :email,
              password    = :password,
              role        = :role

        WHERE id          = :id
      ');
    $result = $query->execute(array(
      ':id'           => $id,
      ':firstname'    => $data['firstname'],
      ':lastname'     => $data['lastname'],
      ':email'        => $data['email'],
      ':password'     => $data['password'],
      ':role'         => $data['role']
    ));
    return $result;
  }
  return null;
}

function deleteUser($id) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare('DELETE FROM user WHERE id = :id');
    $result = $query->execute(array(':id' => $id));
    return $result;
  }
  return null;
}
?>
