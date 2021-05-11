<?php
session_start();

/* !!!! ATTENTION : Si probleme de SQL regarder dans connex.inc.php  et   param.inc.php c'est surrement de là que vient le probleme !!!!!!*/
?>


<!DOCTYPE html>

<html lang="fr">

	<head>
    <link rel="shortcut icon" href="#">
		<meta charset="utf-8">
		<title>Formule 1</title>
		<link rel="stylesheet" type="text/css" href="style/Accueil.css">
    <link rel="stylesheet" type="text/css" href="style/navigation.css">
		<script type="text/javascript" src="scripts/slidesImages.js"></script>
    <script type="text/javascript" src="scripts/navigation.js"></script>
    <script type="text/javascript" src="scripts/sonVideo.js"></script>
    <script type="text/javascript" src="scripts/formInputMax.js"></script>
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
      } else {
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
      /*Si il est connecté  */
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
        } else {
          echo "<a href='ConnexionGestion/deconnexion.php' class='serveur'>Deconnexion</a>";
        }
      } else {
        echo <<<END
        <a onclick="document.getElementById('connexionFen').style.display='block'" class='serveur'>Connexion</a>
        END;
        echo <<<END
        <a onclick="document.getElementById('inscriptionFen').style.display='block'" class='serveur'>Inscription</a> 
        END;
      }
      ?>

		</div>
















    
    <!-- le div main ici est important car il coupe la page entre navigation et le reste de la page -->
    <!-- cela fait que quand on appuie sur l'image pour ouvrir la navigation, tout le reste de la page bouge a l'unisson-->
		<div id="main">

      <video autoplay="true" muted="true" loop="true" id="myVideo">
        <source src="video/2021-f1-opening-titles.mp4" type="video/mp4">
      </video>
      <button type="button" onclick="unmuteVideo()" id="boutonSonVideo" value="Off">Unmute</button>



			<article>
				<div class="articlePress">
          <span>
            <h1> Bienvenue ! </h1>
          </span>
					<p id="p1">Dans le but de réaliser un site internet avec la faculté de sciences de Saint-Etienne, Jocelyn Hauf et Sylvain Rome ont monté ce site.<br>
          Laissons leur la parole : </p>
          <p id="p2">Bonjour ! <br> 
            Pour commencer, nous avons réfléchi au type de site que nous voulions créer, il fallait qu'il corresponde aux attentes du sujet, mais aussi que son code soit à notre portée. De ce fait le choix fût de créer un site à but informatif avec la possibilité d'interaction avec l'utilisateur.<br>
          <br>
          Par la suite, il nous a fallut trouver une thématique intéressante et correspondant au caractère informatif du site, ainsi nous nous sommes mit d'accord sur un thème qui nous plaît à tous deux et sur lequel nous avions quelques connaissances, qui est la Formule 1.<br>
          <br>
          <br>
          Ce Site propose donc: <br>
          <br>
            - Un classement des meilleurs pilotes du moment classés par saisons et par carrieres<br>
            - Un blog pour echanger des différentes actus de formule 1 ou autres<br>
            - Une actualisation sur la prochaine course à venir<br>
            <br>
            Bonne découverte !
					</p>
				</div>
      


        <!-- images pouvant etre défilées -->
				<div class="slideshow-container">
            <!-- chargement des images mais seule la deuxieme avec la class firstSlide est affichée a l'entrée sur la page, les images changent vie des fleches ou des points -->
  					<div class="mySlides fade ">
    					<div class="numbertext">1 / 3</div>
    					<img src="images/equipes/renault_formule1.jpg" style="width:100%">
    					<div class="text">Renault</div>
  					</div>

  					<div class="mySlides fade">
    					<div class="numbertext">2 / 3</div>
   						<img src="images/equipes/williams_formule1.jpg" style="width:100%">
    					<div class="text">Williams</div>
  					</div>

  					<div class="mySlides fade firstSlide">
    					<div class="numbertext">3 / 3</div>
    					<img src="images/equipes/alpine_formule1.jpg" style="width:100%">
    					<div class="text">Alpine</div>
  					</div>

            <!-- fleches appelant la fonction plusSlide, pour avoir l'image d'avant un fait un -1 et pour celle d'apres un +1 car la valeur de l'image affichée oscille entre 1 et 3 -->
  					<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  					<a class="next" onclick="plusSlides(1)">&#10095;</a>

            <br>
				</div>
        <!-- les trois petits points en dessous de l'image appelent une fonction qui change l'image par l'image etant liée au point sur lequel on a appuyé ex: 3eme point appelle le display de l'image 3-->
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
        </article>

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
			<form class="modal-content" action="ConnexionGestion/connecter.php" method="POST" style="border:1px solid #ccc">
  				<div class="container">
    				<h1>Connexion</h1>
    				<p>Remplissez pour la connexion</p>
    				<hr>

    				<label for="nom"><b>Username</b></label><br>
    				<input type="text" onKeyUp="longueurMax(this, 30);" placeholder="Entrer Username" name="nom" required>
    				<br>
            <label for="passe"><b>Mot de passe</b></label><br>
            <input type="password" onKeyUp="longueurMax(this, 30);" placeholder="Entrer mot de passe" name="passe" id="passe-bar3" required>
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
