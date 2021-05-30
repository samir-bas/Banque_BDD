DROP DATABASE IF EXISTS banque;

CREATE DATABASE banque CHARACTER SET 'UTF8';

DROP USER IF EXISTS 'banque'@'localhost'; 
CREATE USER 'banque'@'localhost' IDENTIFIED BY 'Sam123';
GRANT ALL PRIVILEGES ON banque.* TO 'banque'@'localhost';

CREATE TABLE titulaire (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  nom varchar(80)  NOT NULL,
  prenom varchar(80)  NOT NULL,
  email varchar(80)  NOT NULL,
  password varchar(80)  NOT NULL,
  PRIMARY KEY (id)
) ;

INSERT INTO titulaire (id, nom, prenom, email, password) VALUES
(1, 'BEN ABDESSALEM', 'SAMIR', 'samir.bas.pro@gmail.com', 'Sam123456'),
(2, 'CASTEX', 'JEAN', 'castex.jean@gmail.com', 'Jean_macron'),
(3, 'SAMANTHA', 'FOX', 'samantha.fox@yahoo.com', '123456');

CREATE TABLE typecompte (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  nom varchar(80),
  PRIMARY KEY (id) 
) ;

INSERT INTO typecompte (id, nom) VALUES
(1, 'COMPTE COURANT'),
(2, 'LIVRET A'),
(3, 'PEL');

CREATE TABLE compte (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  numcompte varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  typecompte_id int(10) UNSIGNED NOT NULL,
  date_ouverture date NOT NULL DEFAULT current_timestamp(),
  derniere_op date NOT NULL DEFAULT '1000-01-01',
  solde decimal(7,2) NOT NULL,
  titulaire_id int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (titulaire_id) REFERENCES titulaire(id)
) ;

INSERT INTO compte (id, numcompte, typecompte_id, date_ouverture, derniere_op, solde, titulaire_id) VALUES
(1, '7630001007941234567890185', 2, '2021-05-20', '2021-05-23', 26000.50, 1),
(2, '7630004000031234567890143', 2, '2021-05-01', '2021-05-14', 120.00, 2),
(3, '7630006000011234567890189', 1, '2010-06-03', '2020-12-10', 365.80, 3),
(4, '7612548029981234567890161', 1, '2020-12-01', '2021-01-01', 1100.00, 1),
(5, '7642559000011234567890121', 3, '2021-05-10', '2021-05-12', 850.10, 2);


CREATE TABLE operation (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  compte_id int(10) UNSIGNED NOT NULL,
  date_operation date NOT NULL,
  montant decimal(7,2) NOT NULL,
  type_operation tinyint(4) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (compte_id) REFERENCES compte(id)
) ;


INSERT INTO operation (id, compte_id, date_operation, montant, type_operation) VALUES
(1, 1, '2021-05-21', 100.10, 1),
(2, 4, '2021-05-19', 520.12, 2),
(3, 2, '2021-05-23', 620.00, 1),
(4, 1, '2021-05-20', 1000.00, 1);

