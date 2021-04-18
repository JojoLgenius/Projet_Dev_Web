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
		<link rel="stylesheet" type="text/css" href="nextrace.css">
		<script type="text/javascript" src="Projet.js"></script>
	</head>

	<!--
	La page appelle chrono de Projet.js
	Elle s'actualise toute les 5min pour éviter d'avoir un retard sur le chrono
	-->
  <body onLoad="window.setTimeout('history.go(0)', 300000) ; chrono()">
		<header>
		<!--Icone Maison (bootsrap.com) renvoie au menu principal-->
		<a href="Accueil.html">
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
  </body>

</html>
