<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Enregistrement</title>
    <link rel="stylesheet" type="text/css" href="OUIOUIOUI.css">
  </head>
  <body>
  	<center>

<?php
if (isset($_POST['nom']) && isset($_POST['passe']))
{

	$nom = htmlspecialchars($_POST['nom']);
	$passe = $_POST['passe'];

	include('connex.inc.php');
	$pdo = connexion('bdd_membre');


	$stmt = $pdo->prepare("SELECT id, passe, classe FROM membres WHERE nom = :nom");
	$stmt->bindParam(':nom', $nom);
	$stmt->execute();
	$resultat = $stmt->fetch();

	$passeOk = password_verify($passe,$resultat['passe']);

	if (!$resultat){
		echo '<h1>Mauvais id ou mot de passe ! de resultat</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
	}

	else {
		if ($passeOk){ 
			$_SESSION['id'] = $resultat['id'];
			$_SESSION['nom'] = $nom; 
			$_SESSION['classe'] = $resultat['classe'];
			echo '<h1>Vous etes connecté !</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
		}
		else {
			echo '<h1>Mauvais id ou mot de passe ! de passOk</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
		}
	}
 
    $stmt->closeCursor();
    $pdo = null;
} else {
	echo '<h1>Mauvais paramètres</h1> <br> <a href="../Accueil.php">Revenir accueil</a>';
}
?>

		<meta http-equiv="refresh" content="2; url=../Accueil.php" />
		</center>
	</body>
</html>
