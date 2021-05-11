<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Suppression Commentaire</title>
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="Blog.css">
  </head>
  <body>
    <center>
      <?php 
      if (isset($_GET['idCom'])) {
        $id = intval($_GET['idCom']);
        include('../ConnexionGestion/connex.inc.php');
        $pdo = connexion('bdd_membre');

        try {
          $stmt = $pdo->prepare("DELETE FROM commentaires WHERE id = :id");
                  $stmt->bindParam(':id', $id);
                  $stmt->execute();
                  echo '<h1>Commentaire supprimé</h1> <br> <a href="../Blog.php">Revenir Parametres</a>';

                  $stmt->closeCursor();
                  $pdo = null;
        }
        catch(PDOException $e) {
                  echo '<h1>Problème PDO</h1> <br> <a href="../Blog.php">Revenir Parametres</a>';
                  echo $e->getMessage();
                }
      }
      else {
              echo "<h1>Mauvais paramètres</h1> <br> <a href='../Blog.php'>Revenir Parametres</a>";
      }
      ?>
    </center>
    <meta http-equiv="refresh" content="1; url=../Blog.php" />
  </body>
 </html>