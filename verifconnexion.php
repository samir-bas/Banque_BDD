<?php 
include "header.php" ;
require "connect_db.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
  $requete = "select id, email, password
  from titulaire 
  where email = ? and password = ?"  ;
  $result = $db_banque->prepare($requete);
  $result->execute(array($_POST['email'],$_POST['password']));
  $titulaire = $result->fetch(PDO::FETCH_ASSOC);
  // if the result match then an array is returned else false (d'où la nécessité de mettre le test en premier si c'est bon)
    if($titulaire  && $_POST['email'] === $titulaire['email'] && $_POST['password'] === $titulaire['password'] ) {
      header("Location: index.php");  
    } 
    else {
      echo "Login et mot de passe non valide" ;
    }
}

include "footer.php" ?>