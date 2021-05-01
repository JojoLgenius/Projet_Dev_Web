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
  console.log(slideIndex-1);

  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}












