/* verifie l'email entré */
function verifierEmail(mail) 
{   /* il faut un caractere quelquonque suivi de @ suivi de lettres ou de chiffres suivi d'un point et de caracteres à nouveau */
 	if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail.value))
  	{
    	return true;
  	}
    alert("Mauvaise addresse Email !");
    return false;
}

function verifierText(texte,nbchar)
{   /* on verifie juste si il a du texte de plus de 'nbchar' lettres dans les cases du formulaire */
	var tab = texte.value.split('');
        if (tab.length < nbchar) {
          alert("Le nom, le prenom ou le message sont erronés !");
          return false;
        }
        return true;
}

/* verifie les donées et renvoie vrai si tout les tests sont bons */ 
function verifierDonnees()
{
    var email = document.getElementById("email"),
    	nom = document.getElementById("nom"),
    	prenom = document.getElementById("prenom")
    	message = document.getElementById("message");

    if (verifierEmail(email) 
    	&& verifierText(nom,2)
    	&& verifierText(prenom,2)
    	&& verifierText(message,40))
    {
        alert("Le formulaire est correct");
        return true;
    } else {
        return false;
    }
}



    