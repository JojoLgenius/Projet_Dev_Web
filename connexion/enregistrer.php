<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Enregistrement</title>
  </head>
  <body>
      <?php if (isset($_POST['nom'],$_POST['passe'],$_POST['id'])) {
          $classe = 'membre';
          $id = $_POST['id'];
          $nom = htmlspecialchars($_POST['nom']);
          $passe = password_hash($_POST['passe'], PASSWORD_DEFAULT);

          include('connex.inc.php');
          $pdo = connexion('bdd_membre');
          try {
              $stmt = $pdo->prepare('UPDATE membres SET classe=:classe,nom=:nom,passe=:passe WHERE id=:id');
              $stmt->bindParam(':id', $id);
              $stmt->bindParam(':nom', $nom);
              $stmt->bindParam(':classe', $classe);
              $stmt->bindParam(':passe', $passe);

              $stmt->execute();

              if ($stmt->rowCount() == 1) {
                  echo '<p>Modification effectuée</p> <br> <a href="../Accueil.php">Revenir accueil</a>';
              } else {
                  echo '<p>Erreur</p> <br> <a href="../Accueil.php">Revenir accueil</a>' ;
              }
          } catch(PDOException $e) {
              echo '<p>Problème PDO</p> <br> <a href="../Accueil.php">Revenir accueil</a>';
              echo $e->getMessage();
          }
          $stmt->closeCursor();
          $pdo = null;
      } else {
          echo '<p>Mauvais paramètres</p> <br> <a href="../Accueil.php">Revenir accueil</a>';
      }?>
  </body>
</html>