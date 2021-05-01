<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Enregistrement</title>
    <link rel="stylesheet" type="text/css" href="StylePartieConnexion.css">
  </head>
  <body>
    <center>
      <?php
      /* recupere le nom l'id et le mdp envoyés par le formulaire de modifier.php */ 
      if (isset($_POST['nom'],$_POST['passe'],$_POST['id'])) {
          /*initialisation des nouvelles variables pour la requete de modification */
          $classe = 'membre';
          $id = $_POST['id'];
          $nom = htmlspecialchars($_POST['nom']);
          $passe = password_hash($_POST['passe'], PASSWORD_DEFAULT);

          /* connexion pdo */
          include('connex.inc.php');
          $pdo = connexion('bdd_membre');
          try {
              /*preparation de la requete de modification */
              $stmt = $pdo->prepare('UPDATE membres SET classe=:classe,nom=:nom,passe=:passe WHERE id=:id');
              $stmt->bindParam(':id', $id);
              $stmt->bindParam(':nom', $nom);
              $stmt->bindParam(':classe', $classe);
              $stmt->bindParam(':passe', $passe);
              /*utilisateur modifié*/
              $stmt->execute();
              /*on regarde si ca a marché*/
              if ($stmt->rowCount() == 1) {
                  echo '<p>Modification effectuée</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              } else {
                  echo '<p>Erreur</h1> <br> <a href="../Accueil.php">Revenir accueil</a>' ;
              }
          /* Si il y a une erreur dans les requetes sql ou PDO on affiche l'erreur pour le debugging*/
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
    <meta http-equiv="refresh" content="1; url=../Accueil.php" />
  </body>
</html>