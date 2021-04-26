<?php
session_start();
?>

<!DOCTYPE html>

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>Formule 1</title>
		<link rel="stylesheet" type="text/css" href="Accueil.css">
		<script type="text/javascript" src="Projet.js"></script>
	</head>

	<body>

		<div id="imageNavContainer">
			<img id="imageNav" src="images/navImage.png" alt="menu" onclick="openNav()">
	    </div>

		<div id="mySidenav" class="sidenav"> 		
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

      <?php 
      if (isset($_SESSION['id']) AND isset($_SESSION['nom']) AND isset($_SESSION['classe'])){
        if ($_SESSION['classe'] == 'admin' ){
          echo "<a class='serveurInfo'>". $_SESSION['classe'] ." ". $_SESSION['nom'] ."</a><a class='serveurInfo'> Connecté</a><br>" ;
        } else {
          echo "<a class='serveurInfo'>". $_SESSION['classe'] ." ". $_SESSION['nom'] ."</a><a class='serveurInfo'> Connecté</a><br>" ;
        }
      } else {
        echo "<a class='serveurInfo'>Non connecté</a>";
      }
      ?>

      <br>

  		<a href="Accueil.php">Accueil</a>
  		<a href="BlogGestion/Blog.php">Blog</a>
  		<a href="#">Actus</a>
  		<a href="#">Contact</a>
			<a href="nextrace.php">Prochaine course</a>

      <br>
      <br>


      <?php

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
				<div class="title">
					<div class="card-holder">
						<div class="card bg-header">
							Formule1
						</div>
					</div>
				</div>
			</header>

			<article>
				<div class="articlePress">
					<h1> Le site </h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</p>

				</div>






				<div class="slideshow-container">

  					<div class="mySlides fade ">
    					<div class="numbertext">1 / 3</div>
    					<img src="images/equipes/renault_formule1.jpg" style="width:100%">
    					<div class="text">Renault</div>
							<div class="licence">licence</div>
  					</div>

  					<div class="mySlides fade firstSlide">
    					<div class="numbertext">2 / 3</div>
   						<img src="images/equipes/williams_formule1.jpg" style="width:100%">
    					<div class="text">Williams</div>
							<div class="licence">licence</div>
  					</div>

  					<div class="mySlides fade">
    					<div class="numbertext">3 / 3</div>
    					<img src="images/equipes/alpine_formule1.jpg" style="width:100%">
    					<div class="text">Alpine</div>
							<div class="licence">licence</div>
  					</div>

  					<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  					<a class="next" onclick="plusSlides(1)">&#10095;</a>
				</div>
				<br>

				<div style="text-align:center">
  					<span class="dot" onclick="currentSlide(1)"></span>
  					<span class="dot" onclick="currentSlide(2)"></span>
  					<span class="dot" onclick="currentSlide(3)"></span>
				</div>
			</article>

		</div>


		<div id="inscriptionFen" class="modal">
        	<span onclick="document.getElementById('inscriptionFen').style.display='none'" class="close" title="Close Modal">&times;</span>
			<form class="modal-content" action="ConnexionGestion/ajouter.php" method="POST" style="border:1px solid #ccc">
  				<div class="container">
    				<h1>Inscription</h1>
    				<p>Remplissez les informations pour vous inscrire</p>
    				<hr>

    				<label for="nom"><b>Username</b></label><br>
    				<input type="text" placeholder="Entrer Username" name="nom" required><br>

    				<label for="passe"><b>Mot de passe</b></label><br>
    				<input type="password" placeholder="Mot de passe" name="passe" required><br>

    				<label for="pass-repeat"><b>Réécrire le mot de passe</b></label><br>
    				<input type="password" placeholder="Repéter mot de passe" name="passe-repeat" required><br>

    				<div class="clearfix">
      					<button type="button" onclick="document.getElementById('inscriptionFen').style.display='none'" class="retourbtn">Retour</button>
      					<button type="submit" class="inscriptionbtn">S'inscrire</button>
    				</div>
  				</div>
			</form>
		</div>


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
            <input type="text" placeholder="Entrer mot de passe" name="passe" required>
            <br>

    				<div class="clearfix">
      					<button type="button" onclick="document.getElementById('connexionFen').style.display='none'" class="retourbtn">Retour</button>
      					<button type="submit" class="inscriptionbtn">Se connecter</button>
    				</div>
  				</div>
			</form>
		</div>

    <div id="adminFen" class="modal">
          <span onclick="document.getElementById('adminFen').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="ConnexionGestion/resultats.php" method="POST" style="border:1px solid #ccc">
          <div class="container">
            <h1>Connexion</h1>
            <p>Remplissez pour la connexion</p>
            <hr>

            <label for="nom"><b>Username</b></label><br>
            <input type="text" placeholder="Entrer Username" name="nom">
            <br>

            En ordre: 
            <label>Croissant <input type="radio" name="ordre" value="ASC" checked="checked"></label> 
            <label>Décroissant <input type="radio" name="ordre" value="DESC"></label><br>

            <div class="clearfix">
                <button type="button" onclick="document.getElementById('adminFen').style.display='none'" class="retourbtn">Retour</button>
                <button type="submit" class="inscriptionbtn">Se connecter</button>
            </div>
          </div>
      </form>
    </div>


	</body>

</html>
