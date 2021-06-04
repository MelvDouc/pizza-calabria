<?php

require "./src/classes/NavItem.php";

$navList = [
  "accueil" => "Accueil",
  "menu" => "Notre menu",
  "infos-legales" => "Informations légales"
];
$pages = [
  "accueil" => "accueil.html"
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

function setRoutes()
{
  global $pages;
  $slug = array_key_first($_GET);

  if (!array_key_exists($slug, $pages)) {
    require "./src/pages/accueil.html";
    return;
  }

  foreach ($pages as $key => $file) {
    if (!isset($_GET[$key]))
      continue;
    require "./src/pages/$file";
    break;
  }
}
