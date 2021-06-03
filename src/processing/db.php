<?php

try {
  $host = "localhost";
  $dbName = "pizza-calabria";
  $user = "root";
  $password = "";

  $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $password);
} catch (PDOException $e) {
  print "Erreur : " . $e->getMessage() . "<br/>";
  die();
}
