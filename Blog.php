<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Blog</title>
		<link rel="stylesheet" type="text/css" href="Blog.css">
	</head>
 	<body>
 		<center>
 			<header>
 				<h1>Blog Fomule1</h1>
 			</header>

<?php


			try
			{
				include_once("../ConnexionGestion/param.inc.php");
				$pdo = new PDO("sqlite:.db");
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='membres';");
				if (count($stmt->fetchAll()) === 0) { // table does not exists
          			$table = "CREATE TABLE membres (id INTEGER PRIMARY KEY AUTOINCREMENT,classe VARCHAR(10),nom VARCHAR(30),passe VARCHAR(40));";
          			$pdo->exec($table);
          		}
			} 
			catch(PDOException $e) {
        		die('Erreur : '.$e->getMessage());
			}

			$stmt = $pdo->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

			while ($donnees = $stmt->fetch())
			{
?>
		
			<div class="news">
    			<h3>
        		<?php echo htmlspecialchars($donnees['titre']); ?>
        		<em>le <?php echo $donnees['date_creation_fr']; ?></em>
    			</h3>
    
    			<p>

<?php
    
    			echo nl2br(htmlspecialchars($donnees['contenu']));
?>
    			<br />
    			<em><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em>
    			</p>
			</div>
<?php
			} 
			$req->closeCursor();
?>


 		</center>
 	</body>
</html>
