function verifierEmail(mail) 
{
 	if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail.value))
  	{
    	return true;
  	}
    alert("Mauvaise addresse Email !");
    return false;
}

function verifierText(texte)
{
	var tab = texte.value.split('');
        if (tab.length < 2) {
          alert("Le nom, le prenom ou le message sont erronés !");
          return false;
        }
        return true;
}

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



    