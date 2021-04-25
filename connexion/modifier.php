<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Modification</title>
    <link rel="stylesheet" type="text/css" href="StylePartieConnexion.css">
  </head>
  <body>
    <center>
      <?php if (isset($_GET['id'])) {
          $id = intval($_GET['id']);

          include('connex.inc.php');
          $pdo = connexion('bdd_membre');
          try {
              $stmt = $pdo->prepare('SELECT * FROM membres WHERE id = :id');
              $stmt->bindParam(':id', $id);
              $stmt->execute();
              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
              if (count($results) > 0) {
                  $result = $results[0];
                  echo '<h1>Modifications membre '.$id.':</h1> <br>';
              ?>


      <form action="enregistrer.php" method="POST">
          <label>Username : <input type="text" name="nom" value="<?php echo $result['nom']; ?>"></label>

          <label>Mot de passe : <input type="text" name="passe" value="<?php echo $result['passe']; ?>"></label>

          <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
    
          <button type="submit">Modifier</button>
      </form>


          <?php
              } else {
                  echo '<h1>Membre⋅s non trouvé⋅e</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              }
              $stmt->closeCursor();
              $pdo = null;
          } catch(PDOException $e) {
              echo '<h1>Problème PDO</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              echo $e->getMessage();
          }
      } else {
          echo '<h1>Mauvais paramètres</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
      }?>
  </body>
</html>