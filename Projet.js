function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
  document.getElementById("main").style.marginLeft = "175px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0px";
  document.getElementById("main").style.marginLeft = "0px";
  document.body.style.backgroundColor = "#161616";
}



var slideIndex = 2;

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");

  if (n > slides.length)
  {
  	slideIndex = 1;
  }

  if (n < 1)
  {
  	slideIndex = slides.length;
  }

  for (i = 0; i < slides.length; i++)
  {
      slides[i].style.display = "none";
  }

  for (i = 0; i < dots.length; i++)
  {
      dots[i].className = dots[i].className.replace(" active", "");
  }

  console.log(slideIndex);
  console.log(slideIndex-1)

  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

/*
+---------------------+
| Partie Nextrace.php |
+---------------------+
*/
/*Contient les fonctions utilisés par nextrace.php*/

/*
Gere le temp d'attente avant la prochaine course
Permet de lancer la fonction valeur_chrono tant que la page est ouverture
*/
function chrono(){
  setInterval(valeur_chrono, 1000);
}
/*
Calcul le temp d'attente en fonction des valeurs retournées par le fichier html
Gere les cas suivants:
  secondes arrivent à 0 (decremente minute et remets à 59);
  minutes arrivent à 0 (decremente heure et remets à 59);
  heures arrivent à 0 (decremente jour et remets à 24);
*/
function valeur_chrono(){
  //Initialise les variables dd hh:mm:ss
  //Affichage dans la console pour verifier le fonctionnement
  console.log("Attentes :");
  var ss=parseInt(document.getElementById('ss').innerText);
  console.log("Secondes: "+ss);
  var mm=parseInt(document.getElementById('mm').innerText);
  console.log("Minutes: "+mm);
  var hh=parseInt(document.getElementById('hh').innerText);
  console.log("Heures :"+hh);
  var dd=parseInt(document.getElementById('dd').innerText);
  console.log("Jours :"+dd);
  console.log("");

  //Permet de decrementer le temp
  //Verifie qu'on ne dépasse pas les bornes entre [0-59] (ou [0-24] pour les heures)
  if(ss>0){
    ss--;
    document.getElementById('ss').textContent=ss;
  }
  else{
    ss=59;
    document.getElementById('ss').textContent=ss;
    if(mm>0){
      mm--;
      document.getElementById('mm').textContent=mm;
    }
    else{
      mm=59;
      document.getElementById('mm').textContent=mm;
      if(hh>0){
        document.getElementById('hh').textContent=hh;
        hh--;
      }
      else{
        hh=24;
        document.getElementById('hh').textContent=hh;
        if(dd>0){
          dd--;
          document.getElementById('dd').textContent=dd;
        }
      }
    }
  }
}
