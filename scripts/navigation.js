//fonctions pour le menu deroulant sur le coté de la page
function openNav() {
  document.getElementById("mySidenav").style.width = "220px";
  document.getElementById("main").style.marginLeft = "180px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0px";
  document.getElementById("main").style.marginLeft = "0px";
  document.body.style.backgroundColor = "#161616";
}



var modal = document.getElementById('inscriptionFen');
var modal2 = document.getElementById('connexionFen');
var modal3 = document.getElementById('adminFen');


window.onclick = function(event) {
  if (event.target == modal || event.target == modal2 || event.target == modal3) {
    modal.style.display = "none";
    modal2.style.display = "none";
    modal3.style.display = "none";
  }
}


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