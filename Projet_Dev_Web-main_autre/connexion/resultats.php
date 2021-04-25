<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Résultats</title>
    <link rel="stylesheet" type="text/css" href="OUIOUIOUI.css">
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
            echo '<h1>'.count($membres).' membres.s correspondent à votre requête :</h1>';
            echo '<ul>';

            foreach($membres as $membres) {
                // echo "<li>${etudiant['nom']} ${etudiant['age']} ${etudiant['filiere']}</li>";
                echo '<li> classe : '.$membres['classe'].' <br>nom : '.$membres['nom'].' <br>mdp : '.$membres['passe'].'<br> <a href="supprimer.php?id='.$membres['id'].'">supprimer</a> <a href="modifier.php?id='.$membres['id'].'">modifier</a></li> <br>';
            }
            echo '</ul> <br> <a href="../Accueil.php">Revenir accueil</a>';
            $req->closeCursor();
            $pdo = null;
        } catch(PDOException $e) {
            echo $e->getMessage();
            echo '<h1>Problème avec la base</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
        }
    } else {
        echo '<h1>Critères de recherche non spécifiés </h1> <a href="../Accueil.php">retournez a l\'accueil</a>';
    } ?>
  </body>
</html>