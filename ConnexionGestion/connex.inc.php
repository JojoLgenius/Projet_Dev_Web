<?php
function connexion($base){
  include_once("param.inc.php");
  try {
	  /*aller voir param.inc.php pour changer les parametres de connexion a PDO */
	  /*$base = 'rs05379t';  /*mettre en commentaire si connexion sur MAMP/WAMP ET besoin de mettre son nom d'utilisateur la c'est le mien (option que pour WEBETU) */
  
	  /*connexion a la base de données :   ici sur une bdd de mysql   
	  si l'on utilise MAMP on peut donner un nom a la base ici 'bdd_membres'  
	  si l'on utilise WEBETU alors la base a le meme nom que l'username de l'utilisateur d'où le  $base = 'rs05379t' au dessus */

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
          $mdp = password_hash('lebg', PASSWORD_DEFAULT);
          $adminSpe->bindParam(':classe',$classe);
          $adminSpe->bindParam(':nom',$nom);
          $adminSpe->bindParam(':passe',$mdp);
          $adminSpe->execute();

          $adminSpe = $pdo->prepare("INSERT INTO membres (classe, nom, passe) VALUES (:classe, :nom, :passe)");

          $nom = 'syl42';
          $classe = 'admin';
          $mdp = password_hash('vroum', PASSWORD_DEFAULT);
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
      }


      /*on ouvre une query sur la bdd pour voir si la table commentaires existe  (utililsée pour le blog)*/
      $stmt3 = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME='commentaires';");
      /*si elle n'existe pas alors on la crée et on crée*/
      if (count($stmt3->fetchAll()) === 0) {
          $table3 = "CREATE TABLE commentaires (id INTEGER AUTO_INCREMENT PRIMARY KEY, nomAuteur VARCHAR(30), idArticle INTEGER, contenu TEXT NOT NULL);";
          $pdo->exec($table3);
      }


      $stmt4 = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME='pilotes';");
      if (count($stmt4->fetchAll()) === 0) {
          $table4 = "CREATE TABLE pilotes (id INTEGER AUTO_INCREMENT PRIMARY KEY, pilote VARCHAR(30), pays VARCHAR(30), constructeur VARCHAR(30), pointsTotal INTEGER, pointsSaison INTEGER, podiumsSaison INTEGER, victoiresSaison INTEGER, GP INTEGER);";
          $pdo->exec($table4);

          $pilotes = "INSERT INTO pilotes (pilote, pays, constructeur, pointsTotal, pointsSaison, podiumsSaison, victoiresSaison, GP) VALUES 
          ('Lewis Hamilton', 'Royaume-Uni', 'Mercedes', 3847, 69, 3, 2, 269),
          ('Sebastian Vettel', 'Allemagne', 'Aston Martin', 3018, 0, 0, 0, 260),
          ('Fernando Alonso', 'Espagne', 'Alpine', 1904, 5, 0, 0, 315),
          ('Kimi Räikkönen', 'Finlande', 'Alfa Romeo', 1863, 0, 0, 0, 333),
          ('Valtteri Bottas', 'Finlande', 'Mercedes', 1544, 32, 2, 0, 159),
          ('Max Verstappen', 'Pays-Bas', 'Red Bull', 1223, 61, 3, 1, 122),
          ('Daniel Ricciardo', 'Australie', 'McLaren', 1175, 16, 0, 0, 191),
          ('Sergio Pérez', 'Mexique', 'Red Bull', 728, 22, 0, 0, 194),
          ('Charles Leclerc', 'Monaco','Ferrari', 429, 28, 0, 0, 62),
          ('Carlos Sainz Jr.', 'Espagne', 'Ferrari', 386, 14, 0, 0, 121),
          ('Pierre Gasly', 'France', 'AlphaTauri', 206, 7, 0, 0, 67),
          ('Esteban Ocon', 'France', 'Alpine', 206, 8, 0, 0, 70),
          ('Lando Norris', 'Royaume-Uni', 'McLaren', 183, 37,1 ,0, 41),
          ('Lance Stroll', 'Canada', 'AstonMartin', 147, 5, 0, 0, 81);";
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
