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
 			if (isset($_SESSION['id']) AND isset($_SESSION['nom']) AND isset($_SESSION['classe'])){
 				if ($_SESSION['classe'] == 'admin' ){

 					include('../ConnexionGestion/connex.inc.php');
					$pdo = connexion('bdd_membre');

 					echo "<a href='NouvArt.php'>Faire un nouvel Article</a>";
 					echo "<br><br>";
 					echo "<h1> Liste Articles </h1>";

 					try {
 						$stmt = $pdo->prepare("SELECT * FROM articles");
 						$stmt->execute();
 						$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
 						echo '<h2>'.count($articles).' articles</h1>';
 						echo '<ul>';
 						echo '</center>';
 						foreach($articles as $articles){
 							echo '<li> Titre : '.$articles['titre'].' <br> <a href="supprimerArt.php?id='.$articles['id'].'">supprimer</a></li><br>';

 						}
 						echo '</ul>';
 					}
 					catch(PDOException $e) {
            			echo '<h1>Problème PDO</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
            			echo $e->getMessage();
          			}

 				}
 				else {
 					echo "<h1>Vous n'etes pas autorisé</h1>";
 				}
 			}
 			else {
 				echo "<h1>Vous n'etes pas autorisé</h1>";
 			}
 			?>
 	</body>
 </html>