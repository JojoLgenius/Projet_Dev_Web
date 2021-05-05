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


  } /* Si il y a une erreur dans les requetes sql ou PDO on affiche l'erreur pour le debugging*/
  catch(PDOException $e) {
      echo 'Problème à la connexion <br> <a href="../Accueil.php">Revenir accueil</a>';
      die('Erreur : '.$e->getMessage());
  }
  return $pdo;
}
?>
