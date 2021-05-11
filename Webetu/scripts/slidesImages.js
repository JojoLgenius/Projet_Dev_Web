//fonctions pour les slides d'images 
var slideIndex = 2; //On commence a la slide 2, SlideIndex est le n°de l'image sur laquelle on se trouve en ce moment si == 1 alors l'image 1 sera présentée

function plusSlides(n) {  //incremente la variable slideIndex en appelant showSlide
  showSlides(slideIndex += n);
}


function currentSlide(n) {
  showSlides(slideIndex = n); //appelle showSlide
}


function showSlides(n) {  
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");

  if (n > slides.length) /*slides sont en fait un tableau de valeurs   slides[1][2][3]   1:premiere image 2:deuxieme ...*/
  {
  	slideIndex = 1;    /* si le n est plus grand que la grandeur du tableau alors on revient au debut du tableau */
  }

  if (n < 1)    /* si le n est plus petit que 1 alors on sort du tableau on va alors a la derniere valeur */
  {
  	slideIndex = slides.length;
  }

  for (i = 0; i < slides.length; i++) /* on met toute les images en display none */
  {
      slides[i].style.display = "none";
  }

  for (i = 0; i < dots.length; i++)
  {
      dots[i].className = dots[i].className.replace(" active", "");
  }

  slides[slideIndex-1].style.display = "block"; /* on affiche la bonne image avec un display "block" */
  dots[slideIndex-1].className += " active";
}












