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
 			<div class="modal">
 			<form class="modal-content" action="AjouterArt.php" method="POST" style="border:1px solid #ccc">
  				<div class="container">
    				<h1>Ajout D'article</h1>
    				<p>Remplissez pour ajouter un article</p>
    				<hr>
    				<br>

    				<label for="titre"><b>Titre de l'article</b></label><br>
    				<input type="text" placeholder="Titre de l'article" name="titre" required>
    				<br>

            <label for="contenu"><b>Message</b></label><br>
            <textarea rows="10" cols="40" placeholder="Contenu de l'article" name="contenu"></textarea>
            <br>

            <div class="clearfix">
    				  <button type="submit">Envoyer message</button>
      			  <button type="button" onclick="location.href='ChangerArt.php'" class="retourbtn">Retour</button>
  				  </div>
          </div>
			</form>
			</div>
 		</center>
 	</body>
 </html>