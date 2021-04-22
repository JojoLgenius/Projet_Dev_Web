<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Suppression</title>
  </head>
  <body>
      <?php if (isset($_GET['id'])) {

          $id = intval($_GET['id']);

          include('connex.inc.php');
          $pdo = connexion('bdd_membre');
          try {
              $stmt = $pdo->prepare("DELETE FROM membres WHERE id = :id");
              $stmt->bindParam(':id', $id);
              $stmt->execute();
              echo '<p>'.($stmt->rowCount()).' membre⋅s supprimé⋅e(s)</p> <br> <a href="../Accueil.php">Revenir accueil</a>';
              $stmt->closeCursor();
              $pdo = null;
          } catch(PDOException $e) {
              echo '<p>Problème PDO</p> <br> <a href="../Accueil.php">Revenir accueil</a>';
              echo $e->getMessage();
          }
      } else {
          echo "<p>Mauvais paramètres</p> <br> <a href='../Accueil.php'>Revenir accueil</a>";
      }?>
  </body>
</html>