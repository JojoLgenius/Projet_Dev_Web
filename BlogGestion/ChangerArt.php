<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Options de changement articles</title>
	</head>
 	<body>
 		<center>
 		<?php
 			if (isset($_SESSION['id']) AND isset($_SESSION['nom']) AND isset($_SESSION['classe'])){
 				if ($_SESSION['classe'] == 'admin' ){

 					echo '<a href="NouvArt.php">Faire un nouvel Article </a>';
 					echo '<br><br><br><br>';
 					echo '<h1> Liste Articles </h1>';
 					
 					include("../ConnexionGestion/connex.inc.php");
 					$pdo = connexion('bdd_membre');

 					try {

 						$stmt = $pdo->prepare("SELECT * FROM articles ORDER BY date_article DESC");
 						$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
 						echo '<ul>';

 						foreach($articles as $articles){ 
 							echo '<li> Titre : '.$articles['titre'].' <br>date : '.$articles['date_article']'<br> <a href="supprimerArt.php?id='.$articles['id'].'">supprimer</a></li><br>';
 						}
 						echo '</ul> <br> <a href="../Accueil.php">Revenir accueil</a>';

 						$stmt->closeCursor();
 						$pdo = null;
 					} catch(PDOException $e) {
            			echo '<h1>Problème PDO</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
            			echo $e->getMessage();
          			}

 				} else {
 					echo "<h1>Vous n'etes pas autorisé</h1>";
 				}
 			} else {
 				echo "<h1>Vous n'etes pas autorisé</h1>";
 			}
 		?>

 		<p>Salut</p>
 		</center>
 	</body>
 </html>