<?php
session_start();

/* !!!! ATTENTION : Si probleme de SQL regarder dans connex.inc.php  et   param.inc.php c'est surrement de là que vient le probleme !!!!!!*/
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="shortcut icon" href="#">
		<meta charset="utf-8">
		<title>Contacts</title>
		<link rel="stylesheet" type="text/css" href="style/Contact.css">
		<link rel="stylesheet" type="text/css" href="style/navigation.css">
		<script type="text/javascript" src="scripts/navigation.js"></script>
		<script type="text/javascript" src="scripts/formulaireContacter.js"></script>
		<script type="text/javascript" src="scripts/formInputMax.js"></script>
		<script type="text/javascript" src="scripts/formulaireConnexVerif.js"></script>
 
		<!-- script pour google maps -->
		<script type="text/javascript" src="scripts/map.js"></script>

		<!--Importations de scripts donnés par google pour implanter google maps
		    Marche seulement avec botre clé API, et donc sur les url que nous avons décidés -->
		<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHW2nIfjKcUAbA1DRIjLDXw0FTZV34q4Q&callback=initMap&libraries=&v=weekly"
      async></script>
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
			<a href="Classements.php">Classement</a>
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
			}
			?>
		</div>

















		<div id="main">
			<!-- les cartes des membres du projet -->
			<div class="headerCards">
				<div class="titre-Part">
					<span>Membres du Projet</span>
				</div>
				<div id="card1">
					<div class="card">
  						<img src="images/imgPortrait1.jpg" alt="Sylvain" style="width:50%">
  						<h1>Sylvain Rome</h1>
  						<p class="title">Etudiant L2</p>
  						<p>Jean Monnet  Saint-Etienne</p>
					</div>
				</div>



				<div id="card2">
					<div class="card">
  						<img src="images/imgPortrait1.jpg" alt="Jocelyn" style="width:50%">
  						<h1>Jocelyn Hauf</h1>
  						<p class="title">Etudiant L2</p>
  						<p>Jean Monnet  Saint-Etienne</p>
					</div>
				</div>
			</div>

			<!-- l'incrustation de google maps pour l'endroit ou nous trouver -->
			<div class="Maps">
				<div class="titre-Part">
					<span>Où?</span>
				</div>
				<div id="map"></div>
			</div>


			<!-- Le formulaire de contact qui est envoyé a envoyerMail.php -->
			<div class="footerForm">
				<div class="titre-Part">
					<span>Nous contacter :</span>
				</div>
				<form class="modal-content" onsubmit="return verifierDonnees()" action="ContactGestion/envoyerMail.php" method="POST" id="form1" style="border:1px solid #ccc" novalidate="novalidate">
  				<div class="container">
    				<p>Remplissez les informations pour nous contacter</p>
    				<hr>
    				<!-- On demande le Nom le Prenom l'email et le message 
    					ATTENTION PROBLEME SUR envoyerMail.php COMMANDE MAIL NE MARCHE PAS --> 
    				<label for="nom"><b>Nom</b></label><br>
    				<input type="text" onKeyUp="longueurMax(this, 40);" id="nom" placeholder="Entrer Nom" name="nom" required><br>

					<label for="prenom"><b>Prenom</b></label><br>
    				<input type="text" onKeyUp="longueurMax(this, 40);" id="prenom" placeholder="Entrer Prenom" name="prenom" required>
    				<br>

    				<label for="email"><b>Email</b></label><br>
    				<input type="text" onKeyUp="longueurMax(this, 50);" id="email" placeholder="Email" name="email" required><br>

    				<label for="message"><b>Message</b></label><br>
            		<textarea rows="10" onKeyUp="longueurMax(this, 400);" id="message" cols="40" placeholder="Votre Message" name="message" required></textarea>

    				<div class="clearfix">
                <!-- les boutons en bas du fomulaire pour soit envoyer les informations soit fermer le formulaire et passer .modal en display='none' -->
      					<button type="submit" class="inscriptionbtn">Envoyer</button>
    				</div>
  				</div>
			</form>
			</div>
		</div>





















		<!-- DEBUT FORMULAIRES POUR CONNEXION ADMIN ET INSCRIPTION -->
		<div id="inscriptionFen" class="modal">
          <!-- les options sur le onclick permettent d'afficher les formulaires dans une "fenetre" -->
          <!-- cette fenetre est en fait en cascade devant la page de base   grace a z-index dans le css sous .modal -->
        	<span onclick="document.getElementById('inscriptionFen').style.display='none'" class="close" title="Close Modal">&times;</span>
			<form class="modal-content" onsubmit="return verifierDonneesConnex()" action="ConnexionGestion/ajouter.php" method="POST" style="border:1px solid #ccc">
          <!-- debut formulaire  sui renvoie via POST les informations du fomulaire a "ajouter.php" --> 
  				<div class="container">
    				<h1>Inscription</h1>
    				<p>Remplissez les informations pour vous inscrire</p>
    				<hr>
            <!-- on demande un speudo et deux fois le mdp -->
    				<label for="nom"><b>Username</b></label><br>
    				<input type="text" onKeyUp="longueurMax(this, 30);" placeholder="Entrer Username" name="nom" required><br>

    				<label for="passe"><b>Mot de passe</b></label><br>
    				<input type="password" onKeyUp="longueurMax(this, 30);" placeholder="Mot de passe" name="passe" id="passe-bar1" required><br>

    				<label for="pass-repeat"><b>Réécrire le mot de passe</b></label><br>
    				<input type="password" onKeyUp="longueurMax(this, 30);" placeholder="Repéter mot de passe" name="passe-repeat" id="passe-bar2" required><br>
					
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
			<form class="modal-content" onsubmit="return verifierDonneesConnex()" action="ConnexionGestion/connecter.php" method="POST" style="border:1px solid #ccc">
  				<div class="container">
    				<h1>Connexion</h1>
    				<p>Remplissez pour la connexion</p>
    				<hr>

    				<label for="nom"><b>Username</b></label><br>
    				<input type="text" onKeyUp="longueurMax(this, 30);" placeholder="Entrer Username" name="nom" required>
    				<br>
            		<label for="passe"><b>Mot de passe</b></label><br>
            		<input type="text" onKeyUp="longueurMax(this, 30);" placeholder="Entrer mot de passe" name="passe" id="passe-bar3"required>
            
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
	      	<form class="modal-content" onsubmit="return verifierDonneesConnex()" action="ConnexionGestion/resultats.php" method="POST" style="border:1px solid #ccc">
	          <div class="container">
	            <h1>Recherche</h1>
	            <p>Remplissez pour gerer les utilisateurs</p>
	            <hr>

	            <label for="nom"><b>Username</b></label><br>
	            <input type="text" onKeyUp="longueurMax(this, 30);" placeholder="Entrer Username" name="nom">
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