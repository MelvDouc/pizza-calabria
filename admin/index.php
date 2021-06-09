<?php
session_start();
require "../src/processing/db.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../assets/img/logos/my-icon.png">
  <link rel="stylesheet" href="./admin.css">
  <title>Espace Administrateur</title>
</head>

<body>

  <?php

  switch (array_key_first($_GET)) {
    case "modifier":
      require "./pages/update.php";
      break;
    case "voir-pizzas":
      require "./pages/read.php";
      break;
    case "nouvel-admin":
      require "./pages/create-admin.php";
      break;
    default:
      require "./pages/login.php";
  }
  ?>




</body>

</html>