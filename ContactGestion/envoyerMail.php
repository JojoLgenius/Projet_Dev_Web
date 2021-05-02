
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Envoi d'un message par formulaire</title>
</head>

<body>
    <?php
    if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['email']) AND isset($_POST['message']))
    {

    	$entete = 'From: ' . $_POST['email'] . "\r\n";

    	$message = '<h1>Message envoyé depuis la page Contact de monsite.fr</h1>
    	<p><b>Prenom : </b>' . $_POST['prenom'] . '<br>
        <p><b>Nom : </b>' . $_POST['nom'] . '<br>
        <b>Email : </b>' . $_POST['email'] . '<br>
        <b>Message : </b>' . $_POST['message'] . '</p>';


    	$retour = mail('syl9456@live.com', 'Envoi depuis la page Contact', $message, $entete);
	
    	if ($retour) {
        	echo '<p>Votre message a bien été envoyé.</p>';
    	}
	}
    ?>
    <meta http-equiv="refresh" content="1; url=../Contact.php" />
</body>
</html>