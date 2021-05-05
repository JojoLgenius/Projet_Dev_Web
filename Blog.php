<?php
session_start();

/* !!!! ATTENTION : Si probleme de SQL regarder dans connex.inc.php  et   param.inc.php c'est surrement de là que vient le probleme !!!!!!*/
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="shortcut icon" href="#">
		<meta charset="utf-8">
		<title>Blog</title>
		<link rel="stylesheet" type="text/css" href="style/BlogMain.css">
		<link rel="stylesheet" type="text/css" href="style/navigation.css">
		<script type="text/javascript" src="scripts/navigation.js"></script>
	</head>









 	<body>
 		<!-- image qui quand on appuie dessus ouvre le menu de navigation -->
		<div id="imageNavContainer">
			<img id="imageNav" src="images/navImage.png" alt="menu" onclick="openNav()">
	    </div>

		<div id="mySidenav" class="sidenav"> 		
      		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

      		<?php 
      		/*si la personne est connectée*/
      		/* On lui donne la permission de voir sa classe et si il est connecté */
      		/* Sinon on ecrit deconnecté */
			if (isset($_SESSION['id']) AND isset($_SESSION['nom']) AND isset($_SESSION['classe'])){
			    echo "<a class='serveurInfo'>". $_SESSION['classe'] ." ". $_SESSION['nom'] ."</a><a class='serveurInfo'> Connecté</a><br>";
			}
			else {
			    echo "<a class='serveurInfo'>Non connecté</a>";
			}
			?>

			<br>

			<!-- les boutons dans la navigation menant a d'autres pages le Blog... -->
			<a href="Accueil.php">Accueil</a>
			<a href="Blog.php">Blog</a>
			<a href="Actus.php">Actus</a>
			<a href="Contact.php">Contact</a>
			<a href="nextrace.php">Prochaine course</a>

			<br>
			<br>

			<?php
      		/*Si il est connecté*/
      		/*et si le connecté est admin */
      		/*Il peut gerer les membres et se deconnecter*/
      		/*Si pas admin il se deconnecte juste*/
   			/*si pas connecté alors on lui donne la possibilité de se connecter ou de s'inscrire*/
			if (isset($_SESSION['id']) AND isset($_SESSION['nom']) AND isset($_SESSION['classe'])){
				if ($_SESSION['classe'] == 'admin'){
					echo <<<END
					<a onclick="document.getElementById('adminFen').style.display='block'" class='serveur'>Gérer membres</a>
					END;
					echo "<a href='ConnexionGestion/deconnexion.php' class='serveur'>Deconnexion</a>";
				}
				else {
					echo "<a href='ConnexionGestion/deconnexion.php' class='serveur'>Deconnexion</a>";
				}
			}
			else {
				echo <<<END
				<a onclick="document.getElementById('connexionFen').style.display='block'" class='serveur'>Connexion</a>
				END;
				echo <<<END
				<a onclick="document.getElementById('inscriptionFen').style.display='block'" class='serveur' >Inscription</a> 
				END;
			}?>
		</div>












		<div id="main">

			<div class="headerParallax">
 				<header>
 					<span>BLOG</span>
 				</header>
 			</div>
 				
 			<article>

				<?php
				try {
					include('ConnexionGestion/connex.inc.php');
           			$pdo = connexion('bdd_membre');
					$stmt = $pdo->query('SELECT id, titre, contenu, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh\') AS date_art FROM articles ORDER BY date_art DESC LIMIT 0, 10;');

					while ($articles = $stmt->fetch()){  ?>
						<div class="news">
    						<h3><?php echo htmlspecialchars($articles['titre']); ?></h3>
   							<em class='date'>le <?php echo $articles['date_art']; ?></em>
    						<br>
    						<hr>
    						<br>
  
   							<h4><?php echo nl2br(htmlspecialchars($articles['contenu']));?></h4>
    						<br>
    						<hr>

    						<div class="commentaires">
    						<ul>
    						<?php
    						$stmt2 = $pdo->query('SELECT id, nomAuteur, idArticle, contenu FROM commentaires ORDER BY id DESC');
    						$commentaires = $stmt2->fetchAll();
    						foreach ($commentaires as $commentaire) {
    							if ($commentaire['idArticle'] == $articles['id']){
    							?>
    							 	<li>
									<p style="text-decoration: underline;"><?php echo htmlspecialchars($commentaire['nomAuteur']); ?> : </p>
									<p><?php echo htmlspecialchars($commentaire['contenu']); ?></p>										<?php
									if ($_SESSION['classe'] == 'admin' || $commentaire['nomAuteur'] == $_SESSION['nom']){
									 	echo '<a href="BlogGestion/SuppCom.php?idCom='.$commentaire['id'].'">supprimer</a><br></li><br>';
									}
									echo '<br>';
								}
							}
							echo '</ul>';
							echo '</div>';
							if (isset($_SESSION['id']) AND isset($_SESSION['nom']) AND isset($_SESSION['classe'])){
								?>
								<form class="formCom" action="BlogGestion/AjouterCom.php" method="POST">
									<br>
									<input name="idArticle" type="hidden" value=<?php echo $articles['id'] ?> >
									<input name="nomAuteur" type="hidden" value=<?php echo $_SESSION['nom'] ?> >
									<label for="contenu"><b>Commenter : </b></label>
           							<textarea rows="1" placeholder="Commentaire" name="contenu"></textarea>
           							<input type="submit" value="Envoi">
								</form>
								<?php
							}
							?>
								<br>
								</div>

						<?php
						}
					} catch(PDOException $e) {
            			echo '<h1>Problème PDO</h1> <br> <a href="Accueil.php">Revenir accueil</a>';
            			echo $e->getMessage();
          			}

					$stmt->closeCursor();
					$pdo->null;
				?>
				</article>

			<div class="footerParallax"></div>

			<footer>
				<div id="optionAdmin">
 					<?php 
 					/* on regarde si la personne est connectée */
 					if (isset($_SESSION['id']) AND isset($_SESSION['nom']) AND isset($_SESSION['classe'])){
 						if ($_SESSION['classe'] == 'admin' ){ /*et si c'est una admin alors on lui laisse la possibilité de modifier le blog*/
 							echo '<a href="BlogGestion/ChangerArt.php">Options changer Articles</a>';
 						}
 					}
 					?>
 					</div>
			</footer>

		</div>








		<!-- DEBUT FORMULAIRES POUR CONNEXION ADMIN ET INSCRIPTION -->
		<div id="inscriptionFen" class="modal">
          <!-- les options sur le onclick permettent d'afficher les formulaires dans une "fenetre" -->
          <!-- cette fenetre est en fait en cascade devant la page de base   grace a z-index dans le css sous .modal -->
        	<span onclick="document.getElementById('inscriptionFen').style.display='none'" class="close" title="Close Modal">&times;</span>
			<form class="modal-content" action="ConnexionGestion/ajouter.php" method="POST" style="border:1px solid #ccc">
          <!-- debut formulaire  sui renvoie via POST les informations du fomulaire a "ajouter.php" --> 
  				<div class="container">
    				<h1>Inscription</h1>
    				<p>Remplissez les informations pour vous inscrire</p>
    				<hr>
            <!-- on demande un speudo et deux fois le mdp -->
    				<label for="nom"><b>Username</b></label><br>
    				<input type="text" placeholder="Entrer Username" name="nom" required><br>

    				<label for="passe"><b>Mot de passe</b></label><br>
    				<input type="password" placeholder="Mot de passe" name="passe" id="passe-bar1" required><br>

    				<label for="pass-repeat"><b>Réécrire le mot de passe</b></label><br>
    				<input type="password" placeholder="Repéter mot de passe" name="passe-repeat" id="passe-bar2" required><br>
					
					<input type="checkbox" onclick="showPasse(1)">Montrer Mot de passe

    				<div class="clearfix">

                <!-- les boutons en bas du fomulaire pour soit envoyer les informations soit fermer le formulaire et passer .modal en display='none' -->
      					<button type="button" onclick="document.getElementById('inscriptionFen').style.display='none'" class="retourbtn">Retour</button>
      					<button type="submit" class="inscriptionbtn">S'inscrire</button>
    				</div>
  				</div>
			</form>
		</div>



    <!-- Globalement la meme chose que le formulaire precendent mai renvoie des informations différentes a une page php differente : ici connecter.php -->
		<div id="connexionFen" class="modal">
        	<span onclick="document.getElementById('connexionFen').style.display='none'" class="close" title="Close Modal">&times;</span>
			<form class="modal-content" action="ConnexionGestion/connecter.php" method="POST" style="border:1px solid #ccc">
  				<div class="container">
    				<h1>Connexion</h1>
    				<p>Remplissez pour la connexion</p>
    				<hr>

    				<label for="nom"><b>Username</b></label><br>
    				<input type="text" placeholder="Entrer Username" name="nom" required>
    				<br>
            		  <label for="passe"><b>Mot de passe</b></label><br>
            		<input type="text" placeholder="Entrer mot de passe" name="passe" id="passe-bar3"required>
            
            		<br>
            		<input type="checkbox" onclick="showPasse(2)">Montrer Mot de passe

    				<div class="clearfix">
      					<button type="button" onclick="document.getElementById('connexionFen').style.display='none'" class="retourbtn">Retour</button>
      					<button type="submit" class="inscriptionbtn">Se connecter</button>
    				</div>
  				</div>
			</form>
		</div>



    	<!-- Globalement la meme chose que le formulaire precendent mai renvoie des informations différentes a une page php differente : ici resultats.php pour la recherche en admin-->
    	<div id="adminFen" class="modal">
	        <span onclick="document.getElementById('adminFen').style.display='none'" class="close" title="Close Modal">&times;</span>
	      	<form class="modal-content" action="ConnexionGestion/resultats.php" method="POST" style="border:1px solid #ccc">
	          <div class="container">
	            <h1>Recherche</h1>
	            <p>Remplissez pour gerer les utilisateurs</p>
	            <hr>

	            <label for="nom"><b>Username</b></label><br>
	            <input type="text" placeholder="Entrer Username" name="nom">
	            <br>

	            En ordre: 
	            <label>Croissant <input type="radio" name="ordre" value="ASC" checked="checked"></label> 
	            <label>Décroissant <input type="radio" name="ordre" value="DESC"></label><br>

	            <div class="clearfix">
	                <button type="button" onclick="document.getElementById('adminFen').style.display='none'" class="retourbtn">Retour</button>
	                <button type="submit" class="inscriptionbtn">Rechercher</button>
	            </div>
	          </div>
	      	</form>
    	</div>
 	</body>
</html>
