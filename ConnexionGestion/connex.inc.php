<?php
function connexion($base){
  include_once("param.inc.php");
  try {
  		/*aller voir param.inc.php pour changer les parametres de connexion a PDO */
  
	   $base = 'rs05379t';  /*mettre en commentaire si connexion sur MAMP/WAMP (option que pour WEBETU) */
  
      $pdo = new PDO('mysql:host='.HOTE.'; dbname='.$base.'; charset=utf8',UTILISATEUR,PASSE);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME='membres';");
      if (count($stmt->fetchAll()) === 0) {
          $table1 = "CREATE TABLE membres (id INTEGER AUTO_INCREMENT PRIMARY KEY, classe VARCHAR(10), nom VARCHAR(30), passe VARCHAR(100));";
          $pdo->exec($table1);
          $adminSpe = $pdo->prepare("INSERT INTO membres (classe, nom, passe) VALUES (:classe, :nom, :passe)");

          $nom = 'jojo';
          $classe = 'admin';
          $mdp = password_hash('lebg', PASSWORD_DEFAULT);

          $adminSpe->bindParam(':classe',$classe);
          $adminSpe->bindParam(':nom',$nom);
          $adminSpe->bindParam(':passe',$mdp);
          $adminSpe->execute();
      }


      $stmt2 = $pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME='articles';");
      if (count($stmt2->fetchAll()) === 0) {
          $table2 = "CREATE TABLE articles (id INTEGER AUTO_INCREMENT PRIMARY KEY, titre VARCHAR(300) NOT NULL, contenu TEXT NOT NULL, date_article datetime NOT NULL DEFAULT CURRENT_TIMESTAMP);";
          $pdo->exec($table2);
      }
  }
  catch(PDOException $e) {
      echo 'Problème à la connexion <br> <a href="../Accueil.php">Revenir accueil</a>';
      die('Erreur : '.$e->getMessage());
  }
  return $pdo;
}
?>