
<?php
function connexion($base){
  include_once("param.inc.php");
  try {
      $pdo = new PDO("sqlite:".$base.'.db');
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='membres';");
      if (count($stmt->fetchAll()) === 0) { // table does not exists
          $table = "CREATE TABLE membres (id INTEGER PRIMARY KEY AUTOINCREMENT,classe VARCHAR(10),nom VARCHAR(30),passe VARCHAR(40));";
          $pdo->exec($table);
          $pdo->exec("INSERT INTO membres (classe,nom,passe) VALUES ('admin','jojo',".password_hash('lebg', PASSWORD_DEFAULT)).")";
      }
  }
  catch(PDOException $e) {
      echo 'Problème à la connexion <br> <a href="../Accueil.html">Revenir accueil</a>';
      die();
  }
  return $pdo;
}
?>