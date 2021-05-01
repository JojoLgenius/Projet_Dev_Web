<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Suppression</title>
    <link rel="stylesheet" type="text/css" href="StylePartieConnexion.css">
  </head>
  <body>
    <center>
      <?php 
      /* prend l'id qu'il est sensé recevoir de la page resultats.php comme ils passent par la barre url ce n'est pas tres securisé*/
      if (isset($_GET['id'])) {
          $id = intval($_GET['id']);
          /*connexion pdo*/
          include('connex.inc.php');
          $pdo = connexion('bdd_membre');
          try {
              /*preparation d ela requete de suppression du membre grace a son id */
              $stmt = $pdo->prepare("DELETE FROM membres WHERE id = :id");
              $stmt->bindParam(':id', $id);
              $stmt->execute(); //suppression
              echo '<h1>'.($stmt->rowCount()).' membre⋅s supprimé</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              $stmt->closeCursor();
              $pdo = null;

          /* Si il y a une erreur dans les requetes sql ou PDO on affiche l'erreur pour le debugging*/
          } catch(PDOException $e) {
              echo '<h1>Problème PDO</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              echo $e->getMessage();
          }
      } else {
          echo "<h1>Mauvais paramètres</h1> <br> <a href='../Accueil.php'>Revenir accueil</a>";
      }?>
    </center>
    <meta http-equiv="refresh" content="1; url=../Accueil.php" />
  </body>
</html>