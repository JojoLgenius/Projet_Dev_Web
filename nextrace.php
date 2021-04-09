<!DOCTYPE html>

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>NextRace</title>
		<link rel="stylesheet" type="text/css" href="nextrace.css">
	</head>

  <body onLoad="window.setTimeout('history.go(0)', 1000)">
    <h1>Prochaine Course</h1>
    <?php
    //Date du jour en France
    date_default_timezone_set("Europe/Paris");
    //Ouverture du fichier
    //$file = fopen("textes/course.txt","r");

		if($file=fopen("textes/course.txt","r")){
		// On verifie si la ligne commence par # (->commentaires)
    while(fgetc($file)=='#'){
        do{
            $c=fgetc($file);
        }while($c != "\n");
    }
    //Lecture des lignes
		do{
    $nextcourse=fgets($file);
    $elemcourse=explode(":",$nextcourse);
	}while((date(y)>$elemcourse[2]) || (date('Y')==$elemcourse[2] && date('m')>$elemcourse[1])|| (date('Y')>$elemcourse[2] && date('m')>$elemcourse[1] && date('j')>$elemcourse[0]));

		$date_course=new DateTime($elemcourse[2].'-'.$elemcourse[1].'-'.$elemcourse[0]);
		$ajd=new DateTime();

		$diff=$date_course->diff($ajd);
		echo '<div class="attente">';
		echo '<p class="it">'.$diff->d.'J</p>
					<p class="it">'.$diff->h.'H</p>
					<p class="it">'.$diff->m.'m</p>
					<p class="it">'.$diff->s.'s</p>';
		echo '</div>';
		echo '<h2>'.$elemcourse[5].'</h2>';

		}

		//Si le fichier à un problème d'ouverture
		else{
		echo "<p>Ouverture du fichier impossible car fopen retourne FALSE</p>";
			}

    ?>

  </body>
	<footer>
		<?php
			echo '<p class="date_actuel">'.utf8_encode(date('d/m/Y H:i:s')).'</p>';
		 ?>
	</footer>
</html>
