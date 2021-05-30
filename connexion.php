<?php 
include "header.php" ;
?>
  <!-- MAIN -->
  <main>
    <h2 class="text-center mt-3">Connexion</h2>
    <div class="container ">
      <div class="row w-100" >
        <!-- <div class="col-md-6 offset-3"> -->
        <div class="col-6 offset-3">
          <form action="verifconnexion.php" method="POST" class="mt-3">

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