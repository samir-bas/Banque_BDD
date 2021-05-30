<?php
  session_start();
  include "header.php" ;

  // $requete = "select compte.id, compte.date_ouverture, titulaire.nom, titulaire.prenom, titulaire.solde, titulaire.derniere_op from compte inner join titulaire on compte.titulaire_id = titulaire.id" ;
  // $compte = $db_banque->query($requete);
  //   while ($row = $compte->fetch()) {
  //   echo $row['date_ouverture'];
  // }
  // if (isset($_GET['idtitulaire']) && !empty($_GET['idtitulaire'])) {
  if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
    require "connect_db.php";
    $db_banque = Database::connect();
    $requete = "select compte.id, compte.numcompte, typecompte.nom as nomcompte, compte.date_ouverture, 
    titulaire.nom, titulaire.prenom, compte.solde, compte.derniere_op 
    from compte 
    inner join titulaire on compte.titulaire_id = titulaire.id 
    inner join typecompte on compte.typecompte_id = typecompte.id 
    where titulaire.id = ?" ;
    $result = $db_banque->prepare($requete);
    $result->execute(array($_SESSION["user"]));
    $comptes = $result->fetchall(PDO::FETCH_ASSOC);
    $db_banque = Database::disconnect();
  }
  
?>
    <!-- MAIN -->
    <main>
      <section class="container">
        <p class="h4 mt-2">Vos comptes bancaires <a href="" class="btn btn-success btn-lg">Ajouter</a> </p>
        <div class="row">
          <?php foreach ($comptes as $compte) { ?>
          <div class="col-4">
            <div class="card">
              <div class="card-header font-weight-bold">
                <?php echo $compte['nomcompte'] ?> <br>
                <span> <?php echo $compte['numcompte'] ?> </span>
              </div>
              <div class="card_body">
                <h3 class="card-title"></h3>
                <p class="card-text px-2">Propriètaire : <?php echo $compte['nom'] . ' ' . $compte['prenom'] ?> </p>
                <hr class="col-10 offset-1">
                <p class="card-text px-2">Solde : <?php echo number_format($compte['solde'], 2, ',', ' ') . ' €' ?></p>
                <hr class="col-10 offset-1">
                <p class="card-text px-2">Dernière opération : <?php echo date("d/m/Y", strtotime($compte['derniere_op'])) ?> </p>
                <div class="card-footer mx-auto">
                  <a class="btn btn-primary col-4" href="#">Clôturer</a>
                  <a class="btn btn-primary col-5" href="#">Dépôt/Retrait</a>
                  <a class="btn btn-primary" href="compte.php?idcompte=<?php echo $compte['id'] ?>">
                  <img src="img/backspace.svg" alt="Bootstrap">Voir</a>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </section>
    </main>

<?php include "footer.php" ?>