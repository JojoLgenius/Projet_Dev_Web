<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Options de changement articles</title>
		<link rel="shortcut icon" href="#">
		<link rel="stylesheet" type="text/css" href="Blog.css">
	</head>
 	<body>
 		<center>
 			<?php
 		if (isset($_POST['nomAuteur']) AND isset($_POST['idArticle'])  AND isset($_POST['contenu'])){
 			include('../ConnexionGestion/connex.inc.php');
			$pdo = connexion('bdd_membre');

			$idArticle = intval($_POST['idArticle']);
			$nomAuteur = htmlspecialchars($_POST['nomAuteur']);
			$contenu = htmlspecialchars($_POST['contenu']);

			try {
				$stmt = $pdo->prepare("INSERT INTO commentaires (nomAuteur,idArticle,contenu) VALUES (:nomAuteur,:idArticle, :contenu)");
				$stmt->bindParam(':idArticle',$idArticle);
				$stmt->bindParam(':nomAuteur',$nomAuteur);
				$stmt->bindParam(':contenu',$contenu);
				$stmt->execute();

				if ($stmt->rowCount() == 1) {
                  	echo '<h1>Ajout commentaire effectué</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              	} 
              	else {
                  	echo '<h1>Erreur</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              	}
			}
			catch(PDOException $e) {
              	echo '<h1>Problème PDO</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
              	echo $e->getMessage();
          	}
          	$stmt->closeCursor();
          	$pdo = null;
 		}
 		else {
          echo '<h1>Mauvais paramètres</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
      	}
 		?>
 		</center>
 		<meta http-equiv="refresh" content="2; url=../Blog.php" />
 	</body>
 </html>