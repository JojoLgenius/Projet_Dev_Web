<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Résultats</title>
    <link rel="stylesheet" type="text/css" href="StylePartieConnexion.css">
  </head>
  <body>
    <?php

    /* on recupere les infos du formulaire et on regarde si elles sont bien rentrées */
    /* la page ne peuut donc etre ouverte que par le submit d'un formulaire, formulaire qui ne peut etre ouvert que par un ADMIN dans les ^pages precedentes  dans nav de Accueil,Blog...*/
    if (isset($_POST['nom']) && isset($_POST['ordre']))
    {
        /*connexion pdo*/
        include("connex.inc.php");
        $pdo = connexion('bdd_membre');
        try {

            /*on recupere les noms que l'on veut   si l'admin ne met pas de nom la requete sort tout les noms de tout les membres*/
            $tri = 'nom';
            /*on choisi l'ordre de tri*/
            $ordre = 'ASC';
            if ($_POST['ordre'] === 'DESC') {
                $ordre = 'DESC';
            }
            
            /*requete prenant et triant les membres concernés par les options*/
            $req = $pdo->prepare("SELECT * FROM membres WHERE nom LIKE :nom ORDER BY $tri $ordre");
            $nom = '%'.$_POST['nom'].'%';

            $req->bindParam(':nom', $nom);
            $req->execute();

            /* creation d'une liste de membres choisis par la requete s'appelant $membres*/
            $membres = $req->fetchAll(PDO::FETCH_ASSOC);
            echo '<h1>'.count($membres).' membres.s correspondent à votre requête :</h1>';
            echo '<ul>';

            /* affichege de chaques membres uns pas uns  avec une liste*/
            foreach($membres as $membres) {
                // echo "<li>${etudiant['nom']} ${etudiant['age']} ${etudiant['filiere']}</li>";

                /*on affiche le nom  le mdp cripté   et deux bouton/liens pour changer l'username/mdp grace a l'id du membre */
                echo '<li> classe : '.$membres['classe'].' <br>nom : '.$membres['nom'].' <br>mdp : '.$membres['passe'].'<br> <a href="supprimer.php?id='.$membres['id'].'">supprimer</a> <a href="modifier.php?id='.$membres['id'].'">modifier</a></li> <br>';
            }
            echo '</ul> <br> <a href="../Accueil.php">Revenir accueil</a>';
            $req->closeCursor();
            $pdo = null;
            
        /* Si il y a une erreur dans les requetes sql ou PDO on affiche l'erreur pour le debugging*/
        } catch(PDOException $e) {
            echo $e->getMessage();
            echo '<h1>Problème avec la base</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
        }
    } else {
        echo '<h1>Critères de recherche non spécifiés </h1> <a href="../Accueil.php">retournez a l\'accueil</a>';
    } ?>
  </body>
</html>