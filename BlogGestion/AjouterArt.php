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
 		if (isset($_POST['titre']) AND isset($_POST['contenu'])){
 			if (isset($_SESSION['id']) AND isset($_SESSION['nom']) AND isset($_SESSION['classe'])){
 				if ($_SESSION['classe'] == 'admin' ){
 					include('../ConnexionGestion/connex.inc.php');
					$pdo = connexion('bdd_membre');

					$titre = htmlspecialchars($_POST['titre']);
					$contenu = htmlspecialchars($_POST['contenu']);

					try {
						$stmt = $pdo->prepare("INSERT INTO articles (titre,contenu) VALUES (:titre, :contenu)");
						$stmt->bindParam(':titre',$titre);
						$stmt->bindParam(':contenu',$contenu);

						$stmt->execute();

						if ($stmt->rowCount() == 1) {
                  			echo '<h1>Ajout effectué</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
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
 			}
 		}
 		else {
          echo '<h1>Mauvais paramètres</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
      	}
 		?>
 		</center>
 		<meta http-equiv="refresh" content="2; url=NouvArt.php" />
 	</body>
 </html>
