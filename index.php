<?php 
include "header.php" ;

if (isset($_POST['email']) && isset($_POST['password'])) {
  require "connect_db.php";
  $db_banque = Database::connect();
  $requete = "select id, email, password
  from titulaire 
  where email = ? and password = ?"  ;
  $result = $db_banque->prepare($requete);
  $result->execute(array($_POST['email'],$_POST['password']));
  $titulaire = $result->fetch(PDO::FETCH_ASSOC);
  $db_banque = Database::disconnect();
  // if the result match then an array is returned else false (d'où la nécessité de mettre le test en premier si c'est bon)
    if($titulaire)  {
      if($_POST['email'] === $titulaire['email'] && $_POST['password'] === $titulaire['password'] ) {
        session_start();
        $_SESSION["user"] = $titulaire['id'];
        header("Location: comptes.php");  
      }
    } 
    else {
      echo "Login et mot de passe non valide" ;
    }
}
?>
  <!-- MAIN -->
  <main>
    <h2 class="text-center mt-3">Connexion</h2>
    <div class="container ">
      <div class="row w-100" >
        <!-- <div class="col-md-6 offset-3"> -->
        <div class="col-6 offset-3">
          <form action="" method="POST" class="mt-3">

            <div class="form-group">
              <label for="email" class="form-label mt-1">Email :</label>
              <input type="email" id="email" name="email" class="form-control error" autofocus autocomplete="off">
            </div>

            <div class="form-group">
              <label for="motpasse" class="form-label mt-1">Mot de passe :</label>
              <input type="password" id="password" name="password" class="form-control" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary my-5">Envoyer</button>

          </form>
        </div>
      </div>
    </div>
  </main>

  <?php include "footer.php" ?>