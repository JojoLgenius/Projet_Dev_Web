<!DOCTYPE html>

<!--Nextrace.php
Permet d'afficher une page contenant la prochaine course
Agit en fonction de la date actuelle
Les courses peuvent être entrées à l'avance dans un fichier courses.txt
Le fichier course.txt doit cependant être trié au préalable
Le fichier course.txt doit être rédigé comme le précise son utilisation
-->

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>NextRace</title>
		<link rel="stylesheet" type="text/css" href="style/nextrace.css">
		<link rel="stylesheet" type="text/css" href="style/navigation.css">
		<script type="text/javascript" src="scripts/chrono.js"></script>
		<script type="text/javascript" src="scripts/navigation.js"></script>
	</head>

	<!--
	La page appelle chrono de Projet.js
	Elle s'actualise toute les 5min pour éviter d'avoir un retard sur le chrono
	-->
  <body onLoad="window.setTimeout('history.go(0)', 300000) ; chrono()">



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













	<div id="main">
		<header>
		<!--Icone Maison (bootsrap.com) renvoie au menu principal-->
		<a href="Accueil.php">
			<svg id="home"
				xmlns="http://www.w3.org/2000/svg"
				width="40"
				height="40"
				fill="#BBBBBB"
				viewBox="0 0 15 15">
				<path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
			</svg>
		</a>
		<h1>Prochaine Course</h1>
		</header>

    <?php
		//Seconde a jours
		function sstodd($ss){
			return intdiv($ss,86400);
		}
		//Seconde a heures
		function sstohh($ss){
			return intdiv(($ss%86400),3600);
		}
		//Seconde a minutes
		function sstomm($ss){
			return intdiv((($ss%86400)%3600),60);
		}
		//Reste secondes
		function restss($ss){
			return ((($ss%86400)%3600)%60);
		}
    //Date du jour en France
    date_default_timezone_set("Europe/Paris");
		//La date actuelle
		$ajd=time();
    //Ouverture du fichier
		if($file=fopen("textes/course.txt","r")){
		// On verifie si la ligne commence par # (commentaires)
    while(fgetc($file)=='#'){
        do{
            $c=fgetc($file);
        }while($c != "\n");
    }
    //Lecture des lignes tant que la date d'une course est passée
		//On ne supprime pas les courses pour éventuellement les réutiliser sur une autre page
		do{
    $nextcourse=fgets($file);
    $elemcourse=explode(":",$nextcourse);
		//La date de la prochaine course (récupérée dans course.txt)
		$date_course=strtotime($elemcourse[2].'-'.$elemcourse[1].'-'.$elemcourse[0].' '.$elemcourse[3].':'.$elemcourse[4].':00');
	}while($date_course<$ajd);

		//On calcul la difference avec la date actuelle (exprimé en seconde)
		$att=abs($date_course-$ajd);
		//On affiche le temp d'atente avant la prochaine course
		echo '<div class="attente">';
		echo '<!--Sec totales : +'.$att.'-->';
		echo '<p class="it"><em id="dd">'.sstodd($att).'</em>J</p>
					<p class="it"><em id="hh">'.sstohh($att).'</em>H</p>
					<p class="it"><em id="mm">'.sstomm($att).'</em>m</p>
					<p class="it"><em id="ss">'.restss($att).'</em>s</p>';
		echo '</div>';

		}

		//Si le fichier à un problème d'ouverture
		else{
		echo "<p>Problème à l'ouverture du fichier (courses.txt)</p>";
			}

    ?>

		<div class="circuit">
			<?php
			//On affiche le prochain circuit
					echo '<h2>'.$elemcourse[5].'</h2>';
			 ?>
			 <!--On affiche l'image du circuit pour une
			 meilleure intéraction avec l'utilisateur-->
			 <figure>
			<img class="image"
			src="images/circuits/<?php echo $elemcourse[6]?>"
			alt="Prochain Circuit"
			>
			<figcaption>Source: <em class="source">Wikipedia</em></figcaption>
		</figure>
		</div>

		<footer>
			<?php
				echo '<p class="date_actuel">Date : '.utf8_encode(date('d/m/Y')).'</p>';
			 ?>
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
