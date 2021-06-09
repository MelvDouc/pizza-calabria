<?php

if (!$_SESSION["logged-in"])
  exit("Accès refusé.");

$pizzas = $db->query("SELECT * FROM pizzas");
?>

<h1>Les Pizzas</h1>

<main>
  <?php
  require_once "./sidebar.php";
  ?>

  <section id="content">
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
  </section>
</main>