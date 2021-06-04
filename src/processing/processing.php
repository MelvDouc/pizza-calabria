<?php

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
