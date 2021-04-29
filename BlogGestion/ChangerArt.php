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
 			<?php
 			if (isset($_SESSION['id']) AND isset($_SESSION['nom']) AND isset($_SESSION['classe'])){
 				if ($_SESSION['classe'] == 'admin' ){
 					include('../ConnexionGestion/connex.inc.php');
					$pdo = connexion('bdd_membre');

					echo '<br><br>';
 					echo "<h1> Liste Articles </h1>";
 					echo "<a href='NouvArt.php'>Faire un nouvel Article</a>";

 					try {
 						$stmt = $pdo->prepare("SELECT * FROM articles ORDER BY date_article DESC");
 						$stmt->execute();
 						$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
 						echo '<h2>'.count($articles).' articles</h1>';
 						echo '<ul>';
 						echo '</center>';
 						foreach($articles as $articles){
 							echo '<li> Titre : '.$articles['titre'].'<br> Date : '.$articles['date_article'].' <br> <a href="suppArt.php?id='.$articles['id'].'">supprimer</a></li><br>';

 						}
 						echo '</ul>';

 						echo "<br><br><a href='../Blog.php' style='margin-left: 100px'>Retour au blog</a>";
 					}
 					catch(PDOException $e) {
            			echo '<h1>Problème PDO</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
            			echo $e->getMessage();
          			}

 				}
 				else {
 					echo "<h1>Vous n'etes pas autorisé</h1>";?>
 					<meta http-equiv="refresh" content="2; url=../Blog.php" />
 					<?php
 				}
 			}
 			else {
 				echo "<h1>Vous n'etes pas autorisé</h1>";
 				?>
 				<meta http-equiv="refresh" content="2; url=../Blog.php" />
 				<?php
 			}
 			?>
 	</body>
 </html>