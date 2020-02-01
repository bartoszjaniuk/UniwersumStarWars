function changeImage() {
  var image = document.getElementById('myImage');
  var audioON = new Audio("sounds/lightsaberON.mp3");
  var audioOFF = new Audio("sounds/saberOFF.wav");
  if (image.src.match("saberON")) {
    image.src = "img/saberOFF.png";
      audioOFF.play();

  } else {
    image.src = "img/saberON.png";
    audioON.play();
    
  }
}