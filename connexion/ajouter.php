<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
  </head>
  <body>
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
                  echo '<p>Ajout effectué</p> <br> <a href="../Accueil.html">Revenir accueil</a>';
              } else {
                  echo '<p>Erreur</p> <br> <a href="../Accueil.html">Revenir accueil</a>';
              }
          } catch(PDOException $e) {
              echo '<p>Problème PDO <br> <a href="../Accueil.html">Revenir accueil</a></p>';
              echo $e->getMessage();
          }
          $stmt->closeCursor();
          $pdo = null;
      } else {
          echo '<p>Mauvais paramètres</p> <br> <a href="../Accueil.html">Revenir accueil</a>';
      }?>
  </body>
</html>