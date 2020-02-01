<?php
  session_start();
  if(!isset($_SESSION['zalogowany'])){
    $komunikat = "Nie jesteś zalogowany!";
  }
  else{
    unset($_SESSION['zalogowany']);
    $komunikat = "Wylogowanie prawidłowe!";
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Wylogowanie</title>
    
    <style>
        .img{
             position: absolute;
             top: 50%;
             left: 50%;
             width: 500px;
             height: 500px;
             margin-top: -250px; /* Half the height */
             margin-left: -250px; /* Half the width */
   
        }
        
        .message{
        width: 575px;
        overflow: hidden;
        text-align: center;
        margin: auto;

        }
        
      .logOUT:link, .logOUT:visited {
  background: cadetblue;
  color: white;
  padding: 9px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin-top: 5px;
  border-radius: 5px;
}
    
.logOUT:hover, .logOUT:active {
  background-color: #004d4d;
}
      
      </style>
  </head>
  <body>
   
   <div class="message">
    <p><?=$komunikat?></p>
    <p><a class="logOUT" href="login.php">Powrót do strony logowania</a>
    </p>
    </div>
    
    
    
    <img class="img" src="img/empire.jpg" alt="vader">
  </body>
</html>