<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="shortcut icon" href="#">
		<meta charset="utf-8">
		<title>Blog</title>
		<link rel="stylesheet" type="text/css" href="Blog.css">
	</head>
 	<body>
 		<center>
 			<header>
 				<h1>Blog Formule1</h1>
 				<?php 
 				/* on regarde si la personne est connectée */
 				if (isset($_SESSION['id']) AND isset($_SESSION['nom']) AND isset($_SESSION['classe'])){
 					if ($_SESSION['classe'] == 'admin' ){ /*et si c'est una admain */
 						echo '<a href="ChangerArt.php">Options changer Articles</a>';
 					}
 				}
 				?>
 			</header>

			<?php
			try {
				include('../ConnexionGestion/connex.inc.php');
            	$pdo = connexion('bdd_membre');
				$stmt = $pdo->query('SELECT id, titre, contenu, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_art FROM articles ORDER BY date_art DESC LIMIT 0, 5;');

				while ($donnees = $stmt->fetch()){  ?>

					<div class="news">
    					<h3><?php echo htmlspecialchars($donnees['titre']); ?>
        				<em>le <?php echo $donnees['date_art']; ?></em>
    					</h3>
   
    					<p><?php echo nl2br(htmlspecialchars($donnees['contenu']));?>
    					<br></p>
    					<br>
					</div>

				<?php
				}
			} catch(PDOException $e) {
            	echo '<h1>Problème PDO</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
            	echo $e->getMessage();
          	}

			$stmt->closeCursor();
			$pdo->null;
			?>
 		</center>
 	</body>
</html>
