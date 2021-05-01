<?php
	/* Pour connection MAMP CHANGER :: UTILISATEUR = 'root' PASSE = 'root' */
	/* Sinon pour connection WEBETU :: UTILISATEUR = 'usernameFac' PASSE = 'mdp base de donnée SQL perso' se trouvant sur https://webetu.univ-st-etienne.fr/  : onglet base de données : Montrer mdp 
	exemple : pour WEBETU*/

	define(HOTE,'localhost');
	define(UTILISATEUR,'rs05378t');  
	define(PASSE,'IFD4EJAQ');
	
	/*  /\
		||
		-- un seul des deux doit etre utilisé (on ne define pas 2fois la meme variable)
		||
		\/
	*/
	/*pour MAMP

	define(HOTE,'localhost');
	define(UTILISATEUR,'root');
	define(PASSE,'root')*/
?>
