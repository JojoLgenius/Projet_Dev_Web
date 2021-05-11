/* initialise une  longueur max pour les input, fais ce test a chaques nouvelles entrées de lettres */
function longueurMax(element, max){
    valeur = element.value; /* on prend la valuer de l'input donc une chaine de caracteres */ 
    max = parseInt(max); 
    if(valeur.length > max){  /* on compare la longueur de la chaine de caracteres avec le max */
        element.value = valeur.substr(0, max);  /* si superieur la lettre entrop est enlevée de la valeur de l'input */
    }
}