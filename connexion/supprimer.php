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
      <?php if (isset($_GET['id'])) {

          $id = intval($_GET['id']);

          include('connex.inc.php');
          $pdo = connexion('bdd_membre');
          try {
              $stmt = $pdo->prepare("DELETE FROM membres WHERE id = :id");
              $stmt->bindParam(':id', $id);
              $stmt->execute();
              echo '<h1>'.($stmt->rowCount()).' membre⋅s supprimé</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              $stmt->closeCursor();
              $pdo = null;
          } catch(PDOException $e) {
              echo '<h1>Problème PDO</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              echo $e->getMessage();
          }
      } else {
          echo "<h1>Mauvais paramètres</h1> <br> <a href='../Accueil.php'>Revenir accueil</a>";
      }?>
    </center>
    <meta http-equiv="refresh" content="2; url=../Accueil.php" />
  </body>
</html>