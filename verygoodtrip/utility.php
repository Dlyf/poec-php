<?php

function transformSQLDate($sql_date) {
  $date = date_create($sql_date); //native PHP
  return date_format($date, 'd/m/Y');
  // '2018-08-24' => '24/08/2018'
}


?>
