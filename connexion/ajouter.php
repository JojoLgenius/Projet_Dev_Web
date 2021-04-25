<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="OUIOUIOUI.css">
  </head>
  <body>
    <center>
      <?php if (isset($_POST['nom']) && isset($_POST['passe'])) 
      {
          $classe = 'membre';
          $nom = htmlspecialchars($_POST['nom']);
          $passe = password_hash($_POST['passe'], PASSWORD_DEFAULT);

          include('connex.inc.php');
          $pdo = connexion('bdd_membre');
          try {
              $stmt = $pdo->prepare("INSERT INTO membres (classe, nom, passe) VALUES (:classe, :nom, :passe)");
              $stmt->bindParam(':classe', $classe);
              $stmt->bindParam(':nom', $nom);
              $stmt->bindParam(':passe', $passe);

              $stmt->execute();

              if ($stmt->rowCount() == 1) {
                  echo '<h1>Ajout effectué</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              } else {
                  echo '<h1>Erreur</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              }
          } catch(PDOException $e) {
              echo '<h1>Problème PDO</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              echo $e->getMessage();
          }
          $stmt->closeCursor();
          $pdo = null;
      } else {
          echo '<h1>Mauvais paramètres</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
      }?>

    </center>
    <meta http-equiv="refresh" content="3; url=../Accueil.php" />
  </body>
</html>