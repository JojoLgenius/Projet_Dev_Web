function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
  document.getElementById("main").style.marginLeft = "175px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0px";
  document.getElementById("main").style.marginLeft = "0px";
  document.body.style.backgroundColor = "#161616";
}

var premImage = 1;
showDivs(premImage);

function plusDiv(n) {
  showDivs(premImage += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("slide");

  if (n > x.length) 
  	{
  		premImage = 1;
  	}

  if (n < 1) 
  {
  	premImage = x.length;
  }

  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  x[premImage-1].style.display = "block";
}