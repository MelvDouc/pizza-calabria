<?php
require "../src/processing/db.php";
$pizzas = $db->query("SELECT * FROM pizzas");
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
  if (isset($_GET["modifier"])) {
    require "./pages/update.php";
    return;
  }
  ?>

  <h1>Les Pizzas</h1>

  <?php require_once "./sidebar.php"; ?>

  <main>
    <table>
      <thead>
        <th>Nom</th>
        <th>Ingrédients</th>
        <th>Prix normal</th>
        <th>Prix familial</th>
        <th>Image</th>
        <th>Catégorie</th>
        <th>Action</th>
      </thead>
      <tbody>
        <?php while ($pizza = $pizzas->fetch()) : extract($pizza); ?>
          <tr>
            <td><?= $nom ?></td>
            <td><?= $ingredients ?></td>
            <td><?= $prix_normal ?></td>
            <td><?= $prix_familial ?></td>
            <td>
              <div class="table-center">
                <?php if ($image) : ?>
                  <img src="../assets/img/pizzas/<?= $image ?>" alt="<?= $nom ?>" />
                <?php endif; ?>
              </div>
            </td>
            <td></td>
            <td>
              <div class="table-center">
                <a href="./?modifier&id=<?= $id ?>" type="button" style="margin-bottom:1em;">Modifier</a>
                <a href="../src/processing/processing.php?delete&id=<?= $id ?>" type="button">Supprimer</a>
              </div>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>


</body>

</html>