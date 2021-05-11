//fonctions pour le menu deroulant sur le coté de la page
/* quand on ouvre la navigation la fonction est appelée, 'my sidenav'  se deplace de 220px sur la droite et main prend une margin left de 180px */
function openNav() {
  document.getElementById("mySidenav").style.width = "220px";
  document.getElementById("main").style.marginLeft = "180px";
}

/* contraire de open */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0px";
  document.getElementById("main").style.marginLeft = "0px";
  document.body.style.backgroundColor = "#161616";
}



/* Id des formulaires dans la navigation */
var modal = document.getElementById('inscriptionFen');
var modal2 = document.getElementById('connexionFen');
var modal3 = document.getElementById('adminFen');


/* tout initilisé a display 'none' quand il a un clic en dehors de la fenetre, ferme tout les formulaires pouvant etres la */
window.onclick = function(event) {
  if (event.target == modal || event.target == modal2 || event.target == modal3) {
    modal.style.display = "none";
    modal2.style.display = "none";
    modal3.style.display = "none";
  }
}





/* fonction pour montrer les mots de passes, change le type des input en text si ils sont en password et vice-versa */
/* prend une valeur x car nous avons besoin de distinguer les differents formulaires */
function showPasse(x) {
	var elem1 = document.getElementById("passe-bar1");
	var elem2 = document.getElementById("passe-bar2");
	var elem3 = document.getElementById("passe-bar3");
	
	if (x == 1){ 
		if (elem1.type === "password") {
    		elem1.type = "text";
    		elem2.type = "text";
  		}
  		else {
	 	    elem1.type = "password";
	 	    elem2.type = "password";
  		}
  }
  else {
		if (elem3.type === "password") {
    		elem3.type = "text";
  		}
  		else {
	 	    elem3.type = "password";
  		}
  }
}