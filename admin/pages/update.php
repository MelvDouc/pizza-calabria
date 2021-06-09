<?php
$id = $_GET["id"];
$pizza = $db->query("SELECT * FROM pizzas WHERE id = $id;");
$pizza = $pizza->fetch();
if (!$pizza)
  exit("Numéro de pizza invalide.");
extract($pizza);
?>

<h1>Modifier la pizza</h1>

<main>
  <?php
  require_once "./sidebar.php";
  ?>

  <section id="content">
    <h2><?= $nom ?></h2>

    <form action="../src/processing/processing.php?update&id=<?= $id ?>" method="POST" enctype="multipart/form-data">

      <div id="img">
        <img src="../assets/img/pizzas/<?= $image ?>" alt="<?= $nom ?>">
      </div>

      <div id="form-groups">
        <div class="form-group">
          <label for="nom">Nom</label>
          <input type="text" id="nom" name="nom" placeholder="<?= $nom ?>" />
        </div>

        <div class="form-group">
          <label for="ingredients">Ingrédients</label>
          <textarea id="ingredients" name="ingredients" placeholder="<?= $ingredients ?>"></textarea>
        </div>

        <div class="form-group">
          <label for="prix_normal">Prix normal</label>
          <input type="number" step="any" id="prix_normal" name="prix_normal" placeholder="<?= $prix_normal ?>" />
        </div>

        <div class="form-group">
          <label for="prix_familial">Prix familial</label>
          <input type="number" step="any" id="prix_familial" name="prix_familial" placeholder="<?= $prix_familial ?>" />
        </div>

        <div class="form-group">
          <label for="category">Catégorie</label>
          <select name="category" id="category">

          </select>
        </div>

        <div class="form-group">
          <label for="image">Nouvelle image</label>
          <input type="file" id="image" name="image" />
        </div>

        <input type="submit" value="Valider" />
        <a href="./?delete">Supprimer la pizza</a>
      </div>
    </form>
  </section>
</main>