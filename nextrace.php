<!--Nextrace.php
Permet d'afficher une page contenant la prochaine course
Agit en fonction de la date actuelle
Les courses peuvent être entrées à l'avance dans un fichier courses.txt
Le fichier course.txt doit cependant être trié au préalable
Le fichier course.txt doit être rédigé comme le précise son utilisation
-->

<!DOCTYPE html>

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>NextRace</title>
		<link rel="stylesheet" type="text/css" href="nextrace.css">
		<script type="text/javascript" src="Projet.js"></script>
	</head>

  <body onLoad="window.setTimeout('history.go(0)', 1000)">
		<h1>Prochaine Course</h1>
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
    //Ouverture du fichier
		if($file=fopen("textes/course.txt","r")){
		// On verifie si la ligne commence par # (->commentaires)
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
	}while((date(y)>$elemcourse[2]) || (date('Y')==$elemcourse[2] && date('m')>$elemcourse[1])|| (date('Y')>$elemcourse[2] && date('m')>$elemcourse[1] && date('j')>$elemcourse[0]));
		//deux variables Date
		//La date de la prochaine course (récupérée dans course.txt)
		$date_course=strtotime($elemcourse[2].'-'.$elemcourse[1].'-'.$elemcourse[0].' '.$elemcourse[3].':'.$elemcourse[4].':00');
		//La date actuelle
		$ajd=time();
		//On calcul la difference avec la date actuelle (exprimé en seconde)
		$att=abs($date_course-$ajd);
		//On affiche le temp d'atente avant la prochaine course
		echo '<div class="attente" onLoad="chrono('.sstodd($att).','.sstohh($att).','.sstomm($att).','.restss($att).')">';
		echo '<p class="it dd">'.sstodd($att).'J</p>
					<p class="it hh">'.sstohh($att).'H</p>
					<p class="it mm">'.sstomm($att).'m</p>
					<p class="it ss">'.restss($att).'s</p>';
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
  </body>
	<footer>
		<?php
			echo '<p class="date_actuel">'.utf8_encode(date('d/m/Y H:i:s')).'</p>';
		 ?>
	</footer>
</html>
