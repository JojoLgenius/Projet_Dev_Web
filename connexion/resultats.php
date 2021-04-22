<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Résultats</title>
  </head>
  <body>
    <?php 

    if (isset($_POST['nom']) && isset($_POST['ordre']))
    {
        include("connex.inc.php");
        $pdo = connexion('bdd_membre');
        try {

            $tri = 'nom';

            $ordre = 'ASC';
            if ($_POST['ordre'] === 'DESC') {
                $ordre = 'DESC';
            }
            
            $req = $pdo->prepare("SELECT * FROM membres WHERE nom LIKE :nom ORDER BY $tri $ordre");
            $nom = '%'.$_POST['nom'].'%';

            $req->bindParam(':nom', $nom);
            $req->execute();

            $membres = $req->fetchAll(PDO::FETCH_ASSOC);
            echo '<p>'.count($membres).' membres.s correspondent à votre requête :</p>';
            echo '<ul>';

            foreach($membres as $membres) {
                // echo "<li>${etudiant['nom']} ${etudiant['age']} ${etudiant['filiere']}</li>";
                echo '<li>'.$membres['classe'].' '.$membres['nom'].' '.$membres['passe'].'  <a href="supprimer.php?id='.$membres['id'].'">supprimer</a> <a href="modifier.php?id='.$membres['id'].'">modifier</a></li>';
            }
            echo '</ul> <br> <a href="../Accueil.html">Revenir accueil</a>';
            $req->closeCursor();
            $pdo = null;
        } catch(PDOException $e) {
            echo $e->getMessage();
            echo '<p>Problème avec la base</p> <br> <a href="../Accueil.html">Revenir accueil</a>';
        }
    } else {
        echo '<p>Critères de recherche non spécifiés, <a href="rechercher.html">retournez sur le formulaire.</a></p>';
    } ?>
  </body>
</html>