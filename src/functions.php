<?php

require "./src/classes/NavItem.php";

$navList = [
  "accueil" => "Accueil",
  "menu" => "Notre menu",
  "infos-legales" => "Informations légales"
];

function displayNavItems()
{
  global $navList;
  foreach ($navList as $slug => $text) {
    $navItem = new NavItem($slug, $text);
    $navItem->display();
  }
}

function headTitle()
{
  global $navList;
  $title = "Pizza Calabria";
  foreach ($navList as $slug => $text) {
    if (isset($_GET[$slug])) {
      $title .= " - $text";
      break;
    }
  }
  echo $title;
}
