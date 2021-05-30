<?php 
include "header.php" ;

// if found a parameter idcompte
if (isset($_GET['idcompte']) && !empty($_GET['idcompte'])) {
    require "connect_db.php";
    $db_banque = Database::connect();
    $requete = "select compte.id, compte.numcompte, typecompte.nom as nomcompte, compte.date_ouverture, 
    titulaire.nom, titulaire.prenom, compte.solde, compte.derniere_op,
    operation.id as num_operation, operation.date_operation, operation.libelle, operation.montant, operation.type_operation
    from compte 
    inner join operation on compte.id = operation.compte_id 
    inner join titulaire on compte.titulaire_id = titulaire.id 
    inner join typecompte on compte.typecompte_id = typecompte.id 
    where compte.id = ?
    order by operation.compte_id "  ;
    $result = $db_banque->prepare($requete);
    $result->execute(array($_GET['idcompte']));
    $compte = $result->fetchall(PDO::FETCH_ASSOC);
    $db_banque = Database::disconnect();
?>
    <main>
        <section class="container">
            <p class="h4 mt-2">Compte : <?php echo $compte[0]['nom'] . ' ' . $compte[0]['prenom'] ?></p>
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <?php echo $compte[0]['nomcompte'] ?> <br>
                            <span>
                                <?php echo $compte[0]['numcompte'] ?>
                            </span>
                        </div>
                        <div class="card_body">
                            <h3 class="card-title"></h3>
                            <p class="card-text px-2">Solde :
                                <?php echo number_format($compte[0]['solde'], 2, ',', ' ') . ' €' ?> 
                            </p>
                            <p class="card-text px-2">Dernière opération :
                                <?php echo date("d/m/Y", strtotime($compte[0]["derniere_op"])) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table-striped : permet d'avoir une couleur différente pour les lignes pairs et impairs
                table-hover : permet de voir la ligne séléctionné lors du passage de la souris sur la ligne
                table-bordered : Bordure pour les lignes et colonnes
             -->
            <table class="table table-striped table-hover table-bordered mt-3">
                <thead class="text-center align-middle"> <!--Aligne middle : vertical center on the cell -->
                    <tr>
                    <th scope="col" class="col-1">ID</th>
                    <th scope="col" class="col-1">Date Opération</th>
                    <th scope="col" class="col-5">Libellé</th>
                    <th scope="col" class="col-1">Montant</th>
                    <th scope="col" class="col-1">Type</th>
                    <th scope="col" class="col-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach($compte as $operation) : ?>
                        <tr>
                            <td align="right"><?php echo $operation["num_operation"] ?></td>
                            <td><?php echo date("d/m/Y", strtotime($operation["date_operation"])) ?></td>
                            <td><?php echo $operation["libelle"] ?></td>
                            <td class="text-end">
                                <?php echo number_format($operation["montant"], 2, ',', ' ') . ' €' ?>
                            </td>
                            <!-- <td><?php echo gettype($operation["type_operation"]) ?></td> -->
                           <td><?php echo ($operation["type_operation"] === "1") ? "Débit" : "Crédit" ?></td>
                           <td><a href="" class="btn btn-primary">Modifier</a>
                               <a href="" class="btn btn-danger">Supprimer</a>
                           </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
<?php } ?>