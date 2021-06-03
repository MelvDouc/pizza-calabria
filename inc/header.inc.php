<?php
require "./classes/NavItem.php";

$navList = [
  "accueil" => "Accueil",
  "menu" => "Notre menu",
  "infos-legales" => "Informations légales"
];
?>

<header>
  <nav>
    <ul>
      <?php
      foreach ($navList as $slug => $text) :
        $navItem = new NavItem($slug, $text);
        $navItem->display();
      endforeach;
      ?>
    </ul>
  </nav>

  <div id="site-title">
    <h1>Pizza Calabria</h1>
    <h2>Ouvert 7j/7</h2>
  </div>
</header>