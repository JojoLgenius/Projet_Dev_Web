function verifCaracteresValides(texte)
{
	if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]/.test(texte.value))
  	{
    	return true;
  	}
    alert("Caractere non autorisé !");
    return false;
}


function verifierDonneesConnex()
{
	var nom = document.getElementById("nom"),
		passe = document.getElementById("passe");

	if (verifCaracteresValides(nom)
		&& verifCaracteresValides(passe))
    {
        alert("Le formulaire est correct");
        return true;
    } else {
        return false;
    }
}