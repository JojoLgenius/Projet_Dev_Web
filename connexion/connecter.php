<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Enregistrement</title>
    <style type="text/css"> 
    body { 
    	background-color : black; 
    	color : white;
    }
	</style>
  </head>
  <body>

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
		echo 'Mauvais id ou mot de passe ! de resultat <br> <a href="../Accueil.html">Revenir accueil</a>';
	}

	else {
		if ($passeOk){ 
			$_SESSION['id'] = $resultat['id'];
			$_SESSION['nom'] = $nom; 
			$_SESSION['classe'] = $resultat['classe'];
			echo 'Vous etes connecté ! <br> <a href="../Accueil.html">Revenir accueil</a>';
		}
		else {
			echo 'Mauvais id ou mot de passe ! de passOk <br> <a href="../Accueil.html">Revenir accueil</a>';
		}
	}
 
    $stmt->closeCursor();
    $pdo = null;
} else {
	echo 'Mauvais paramètres <br> <a href="../Accueil.html">Revenir accueil</a>';
}
?>

</body>
</html>
