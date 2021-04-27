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
 			if (isset($_GET['id'])) {

 				$id = intval($_GET['id']);
 				include('../ConnexionGestion/connex.inc.php');
				$pdo = connexion('bdd_membre');

				try {
					$stmt = $pdo->prepare("DELETE FROM articles WHERE id = :id");
              		$stmt->bindParam(':id', $id);
              		$stmt->execute();
              		echo '<h1>Article supprimé</h1> <br> <a href="ChangerArt.php">Revenir Parametres</a>';

              		$stmt->closeCursor();
              		$pdo = null;
				}
				catch(PDOException $e) {
              		echo '<h1>Problème PDO</h1> <br> <a href="ChangerArt.php">Revenir Parametres</a>';
              		echo $e->getMessage();
              	}
 			}
 			else {
          		echo "<h1>Mauvais paramètres</h1> <br> <a href='ChangerArt.php'>Revenir Parametres</a>";
			}
 			?>
 		</center>
 		<meta http-equiv="refresh" content="1; url=ChangerArt.php" />
 	</body>
 </html>

