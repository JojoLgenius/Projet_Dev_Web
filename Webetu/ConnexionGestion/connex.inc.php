<?php
function connexion($base){
  include_once("param.inc.php");
  try {
	  /*aller voir param.inc.php pour changer les parametres de connexion a PDO */
	  
	 
	  $base = UTILISATEUR;

	  /*mettre en commentaire $base (au dessus) si connexion sur MAMP/WAMP*/
  
	  /*connexion a la base de données :   ici sur une bdd de mysql   
	  si l'on utilise MAMP on peut donner un nom a la base ici 'bdd_membres'  
	  si l'on utilise WEBETU alors la base a le meme nom que l'username de l'utilisateur d'où le  $base = UTILISATEUR au dessus */

      $pdo = new PDO('mysql:host='.HOTE.'; dbname='.$base.'; charset=utf8',UTILISATEUR,PASSE);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      /*on ouvre une query sur la bdd pour voir si la table membres existe (utilisée pour gerer les membres du site) */
      $stmt = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME='membres';");
      /*si elle n'existe pas alors on la crée et on crée par la meme occasion un ADMIN */
      if (count($stmt->fetchAll()) === 0) {
          $table1 = "CREATE TABLE membres (id INTEGER AUTO_INCREMENT PRIMARY KEY, classe VARCHAR(10), nom VARCHAR(30), passe VARCHAR(100));";
          $pdo->exec($table1);

          /*creation de l'ADMIN */
          $adminSpe = $pdo->prepare("INSERT INTO membres (classe, nom, passe) VALUES (:classe, :nom, :passe)");

          $nom = 'jojo';
          $classe = 'admin';
          $mdp = password_hash('lerigolo', PASSWORD_DEFAULT);
          $adminSpe->bindParam(':classe',$classe);
          $adminSpe->bindParam(':nom',$nom);
          $adminSpe->bindParam(':passe',$mdp);
          $adminSpe->execute();

          $adminSpe = $pdo->prepare("INSERT INTO membres (classe, nom, passe) VALUES (:classe, :nom, :passe)");

          $nom = 'syl42';
          $classe = 'admin';
          $mdp = password_hash('cuitdesoeufs', PASSWORD_DEFAULT);
          $adminSpe->bindParam(':classe',$classe);
          $adminSpe->bindParam(':nom',$nom);
          $adminSpe->bindParam(':passe',$mdp);
          $adminSpe->execute();
      }

      


      /*on ouvre une query sur la bdd pour voir si la table articles existe  (utililsée pour le blog)*/
      $stmt2 = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME='articles';");
      /*si elle n'existe pas alors on la crée et on crée*/
      if (count($stmt2->fetchAll()) === 0) {
          $table2 = "CREATE TABLE articles (id INTEGER AUTO_INCREMENT PRIMARY KEY, titre VARCHAR(300) NOT NULL, contenu TEXT NOT NULL, date_article datetime NOT NULL DEFAULT CURRENT_TIMESTAMP);";
          $pdo->exec($table2);

          $newArticle = "INSERT INTO articles (titre,contenu) VALUES ('BONJOUR A TOUS','Premier article du blog!')";
		  $pdo->exec($newArticle);
      }




      /*on ouvre une query sur la bdd pour voir si la table commentaires existe  (utililsée pour le blog)*/
      $stmt3 = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME='commentaires';");
      /*si elle n'existe pas alors on la crée et on crée*/
      if (count($stmt3->fetchAll()) === 0) {
          $table3 = "CREATE TABLE commentaires (id INTEGER AUTO_INCREMENT PRIMARY KEY, nomAuteur VARCHAR(30), idArticle INTEGER, contenu TEXT NOT NULL);";
          $pdo->exec($table3);
      }



      /*on ouvre une query sur la bdd pour voir si la table pilotes existe  (utililsée pour le Classement)*/
      $stmt4 = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME='pilotes';");
      if (count($stmt4->fetchAll()) === 0) {
          $table4 = "CREATE TABLE pilotes (id INTEGER AUTO_INCREMENT PRIMARY KEY, pilote VARCHAR(30), pays VARCHAR(30), constructeur VARCHAR(30), pointsTotal INTEGER, pointsSaison INTEGER, podiumsSaison INTEGER, victoiresSaison INTEGER, GP INTEGER);";
          $pdo->exec($table4);

          /*On insert toutes les dernieres informations sur le pilotes */
          $pilotes = "INSERT INTO pilotes (pilote, pays, constructeur, pointsTotal, pointsSaison, podiumsSaison, victoiresSaison, GP) VALUES 
          ('Lewis Hamilton', 'Royaume-Uni', 'Mercedes', 3847, 94, 4, 3, 270),
          ('Sebastian Vettel', 'Allemagne', 'Aston Martin', 3018, 0, 0, 0, 261),
          ('Fernando Alonso', 'Espagne', 'Alpine', 1904, 5, 0, 0, 316),
          ('Kimi Räikkönen', 'Finlande', 'Alfa Romeo', 1863, 0, 0, 0, 334),
          ('Valtteri Bottas', 'Finlande', 'Mercedes', 1544, 47, 3, 0, 160),
          ('Max Verstappen', 'Pays-Bas', 'Red Bull', 1223, 80, 4, 1, 124),
          ('Daniel Ricciardo', 'Australie', 'McLaren', 1175, 24, 0, 0, 192),
          ('Sergio Pérez', 'Mexique', 'Red Bull', 728, 32, 0, 0, 195),
          ('Charles Leclerc', 'Monaco','Ferrari', 429, 40, 0, 0, 63),
          ('Carlos Sainz Jr.', 'Espagne', 'Ferrari', 386, 20, 0, 0, 122),
          ('Pierre Gasly', 'France', 'AlphaTauri', 206, 8, 0, 0, 68),
          ('Esteban Ocon', 'France', 'Alpine', 206, 10, 0, 0, 71),
          ('Lando Norris', 'Royaume-Uni', 'McLaren', 183, 41, 1 ,0, 42),
          ('Lance Stroll', 'Canada', 'AstonMartin', 147, 5, 0, 0, 82);";
          $pdo->exec($pilotes);
      }
      


  } /* Si il y a une erreur dans les requetes sql ou PDO on affiche l'erreur pour le debugging*/
  catch(PDOException $e) {
      echo 'Problème à la connexion <br> <a href="../Accueil.php">Revenir accueil</a>';
      die('Erreur : '.$e->getMessage());
  }
  return $pdo;
}
?>
