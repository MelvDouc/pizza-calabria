CREATE DATABASE IF NOT EXISTS `pizza-calabria`;

CREATE TABLE IF NOT EXISTS `pizzas` (
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(25) NOT NULL,
  ingredients MEDIUMTEXT NOT NULL,
  prix_normal INT(11) NOT NULL,
  prix_familial INT(11) NOT NULL,
  image VARCHAR(100) NULL,
  id_categorie INT(11)
);