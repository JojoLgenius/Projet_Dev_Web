
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../ConnexionGestion/StylePartieConnexion.css">
    <title>Envoi d'un message par formulaire</title>
</head>

<body>
    <?php
    if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['email']) AND isset($_POST['message']))
    {
    	/*
    	$to = 'xeoslolcsgo@gmail.com'; 
    	$subject = 'This is the subject!'; 
    	$body = 'This is the email body.'; 
    	$from = 'From: From Address <xeoslolcsgo@gmail.com>' . "\r\n"; 
    	$option = "-fxeoslolcsgo@gmail.com";
    	$retour = mail($to, $subject, $body, $from, $option); */
	
       	echo '<h1>Votre message a bien été envoyé.</h1>';

	}else {
    	echo "<h1>Votre message n/'a pas été envoyé</h1>";
    }
    ?>
    <meta http-equiv="refresh" content="1; url=../Contact.php" />
</body>
</html>