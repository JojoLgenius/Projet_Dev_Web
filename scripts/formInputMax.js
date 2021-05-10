function longueurMax(element, max){
    valeur = element.value;
    max = parseInt(max);
    if(valeur.length > max){
        element.value = valeur.substr(0, max);
    }
}