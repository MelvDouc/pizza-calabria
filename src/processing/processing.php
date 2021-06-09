<?php

session_start();
require "./db.php";

if (isset($_GET["update"]) && isset($_GET["id"])) {
  extract($_POST);
  $id = $_GET["id"];
  $image = $_FILES["image"];

  // echo "<pre>";
  // // var_dump($prix_normal);
  // // var_dump($prix_familial);
  // var_dump($_POST);
  // echo "</pre>";
  // exit();

  if (strlen($nom) > 0) {
    $query = $db->query("SELECT * FROM pizzas WHERE nom = '$nom';");
    $query = $query->fetch();
    if ($query)
      exit("Une pizza avec ce nom existe déjà.");
    $req = $db->prepare("UPDATE pizzas SET nom = ? WHERE id = $id;");
    $req->bindParam(1, $nom, PDO::PARAM_STR);
    $req->execute();
  }

  if (strlen($ingredients) > 0) {
    $req = $db->prepare("UPDATE pizzas SET ingredients = ? WHERE id = $id;");
    $req->bindParam(1, $ingredients, PDO::PARAM_STR);
    $req->execute();
  }

  if (is_numeric($prix_normal)) {
    $req = $db->prepare("UPDATE pizzas SET prix_normal = ? WHERE id = $id;");
    $req->bindParam(1, $prix_normal, PDO::PARAM_STR);
    $req->execute();
  }

  if (is_numeric($prix_familial)) {
    $req = $db->prepare("UPDATE pizzas SET prix_familial = ? WHERE id = $id;");
    $req->bindParam(1, $prix_familial, PDO::PARAM_STR);
    $req->execute();
  }

  if ($image["name"] !== "") {
    if ($image["size"] > 15e6)
      exit("Fichier trop volumineux.");
    if (
      $image["name"] !== ""
      && $image["type"] !== "image/jpg"
      && $image["type"] !== "image/jpeg"
      && $image["type"] !== "image/png"
      && $image["type"] !== "image/gif"
    )
      exit("Type de fichier invalide.");
    if (!is_dir("../../assets/img/pizzas"))
      mkdir("../../assets/img/pizzas");
    $timestamp = time();
    $extension = pathinfo($image["name"], PATHINFO_EXTENSION);
    $image_name = "$timestamp.$extension";
    move_uploaded_file(
      $image["tmp_name"],
      "../../assets/img/pizzas/$image_name"
    );
    $req = $db->prepare("UPDATE pizzas SET image = ? WHERE id = $id;");
    $req->bindParam(1, $image_name, PDO::PARAM_STR);
    $req->execute();
  }

  header("Location: ../../admin/index.php");
  exit();
}

if (isset($_GET["delete"]) && isset($_GET["id"])) {
  $id = $_GET["id"];

  $req = $db->prepare("DELETE FROM pizzas WHERE id = $id;");
  $req->execute();

  header("Location: ../../admin/index.php");
  exit();
}

if (isset($_GET["create-admin"])) {
  extract($_POST);

  if (
    strlen($pseudo) < 1
    || strlen($email) < 1
    || strlen($mdp1) < 1
    || strlen($mdp2) < 1
  )
    exit("Veuillez renseigner tous les champs.");

  if (strlen($pseudo) < 1)
    exit("Veuillez renseigner un nom d'utilisateur.");

  $query = $db->query("SELECT * FROM admins WHERE pseudo = '$pseudo';");
  $query = $query->fetch();
  if ($query)
    exit("Un compte avec ce pseudo existe déjà.");

  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    exit("Veuillez renseigner une adresse email valide.");

  $query = $db->query("SELECT * FROM admins WHERE email = '$email';");
  $query = $query->fetch();
  if ($query)
    exit("Un compte avec cette adresse email existe déjà.");

  if (strlen($mdp1) < 1)
    exit("Veuillez choisir un mot de passe.");

  if (strlen($mdp2) < 1)
    exit("Veuillez confirmer le mot de passe.");

  if ($mdp1 !== $mdp2)
    exit("Les mots de passe ne se correspondent pas");

  $req = $db->prepare("INSERT INTO admins (pseudo, email, mdp, date_creation, actif) VALUES (:pseudo, :email, :mdp, NOW(), :actif);");
  $mdp = password_hash($mdp1, PASSWORD_BCRYPT);
  $actif = 1;

  $req->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
  $req->bindParam(":email", $email, PDO::PARAM_STR);
  $req->bindParam(":mdp", $mdp, PDO::PARAM_STR);
  $req->bindParam(":actif", $actif, PDO::PARAM_INT);

  $req->execute();
  header("Location: ../../admin/index.php?login.php");
  exit();
}

if (isset($_GET["login"])) {
  extract($_POST);

  if (
    strlen($uuid) < 1
    || strlen($mdp) < 1
  )
    exit("Veuillez renseigner tous les champs.");

  if (strlen($uuid) < 1)
    exit("Veuillez renseigner un nom d'utilisateur ou une adresse email.");

  if (strlen($mdp) < 1)
    exit("Veuillez renseigner le mot de passe.");

  $query = $db->query("SELECT * FROM admins WHERE pseudo = '$uuid' OR email = '$uuid';");
  $query = $query->fetch();

  if (!$query)
    exit("Nom d'utilisateur ou adresse email non trouvée.");

  if (!password_verify($mdp, $query["mdp"]))
    exit("Mot de passe invalide.");

  if ($query["actif"] != 1)
    exit("Veuillez d'abord activer votre compte. Un email de confirmation vient de vous être renvoyé.");

  $_SESSION["logged-in"] = true;
  $_SESSION["userID"] = $query["id"];
  $_SESSION["username"] = $query["pseudo"];
  header("Location: ../../admin/?voir-pizzas");
  exit();
}
