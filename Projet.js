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
