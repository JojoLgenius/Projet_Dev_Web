<?php 
session_start();
?>

<!DOCTYPE html>

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>deconnexion</title>
		<link rel="stylesheet" type="text/css" href="StylePartieConnexion.css">
	</head>
	<body>

<?php
$_SESSION = array();
?>
	<center>
	<h1>Vous vous êtes deconnecté</h1>
	</center>

	<meta http-equiv="refresh" content="2; url=../Accueil.php" />
	</body>
</html>