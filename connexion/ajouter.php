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
          $nom = $_POST['nom'];
          $passe = $_POST['passe'];

          include('connex.inc.php');
          $pdo = connexion('bdd_membre');
          try {
              $stmt = $pdo->prepare("INSERT INTO membres (classe, nom, passe) VALUES (:classe, :nom, :passe)");
              $stmt->bindParam(':classe', $classe);
              $stmt->bindParam(':nom', $nom);
              $stmt->bindParam(':passe', $passe);

              $stmt->execute();

              if ($stmt->rowCount() == 1) {
                  echo '<p>Ajout effectué</p>';
              } else {
                  echo '<p>Erreur</p>';
              }
          } catch(PDOException $e) {
              echo '<p>Problème PDO</p>';
              echo $e->getMessage();
          }
          $stmt->closeCursor();
          $pdo = null;
      } else {
          echo "<p>Mauvais paramètres</p>";
      }?>
  </body>
</html>