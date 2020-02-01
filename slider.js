		    var numer = Math.floor(Math.random()*4)+1;
	
			function schowaj()
			{
				$(".parallax-inner").stop(); 
				$(".parallax-inner").fadeOut(500); 
			}
		
			function zmienSlajd()
			{
                 numer++; if (numer>4) numer=1; 
                 var plik ="<img src=\"img/slajd" + numer + ".png\" />"; 
				 document.getElementById("parallax-inner").innerHTML = plik; 
                 $(".parallax-inner").fadeIn(500); 
				 setTimeout("zmienSlajd()", 55000); 
                 setTimeout("schowaj()", 54500);
			
			}