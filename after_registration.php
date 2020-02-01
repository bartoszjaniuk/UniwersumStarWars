<?php
  session_start();
  
  include 'constants.php';
  
  if(isset($_SESSION['komunikat']) && isset($_SESSION['kod'])){
    $komunikat = $_SESSION['komunikat'];
    $kod = $_SESSION['kod'];
    unset($_SESSION['komunikat']);
    unset($_SESSION['kod']);

  }
  else{
    $komunikat = "Nieznany status rejestracji";
    $kod = UNKNOWN_ERROR;
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Rejestracja użytkownika</title>
    <link href="https://fonts.googleapis.com/css?family=Kodchasan&amp;subset=latin-ext" rel="stylesheet"> 
    <style>
        
        body{
            font-family: 'Kodchasan', sans-serif;
        }
        .workarea{
            background: #fff;
    opacity: 0.9;
    width: 85%;
    max-width: 550px;
    min-height: 400px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 30px; 
    box-sizing: border-box;
    border-radius: 8px;
    box-shadow: 0 0 20px #000000b3;
        }
        img{
            width:400px;
            height: 300px;
        }
        
        
      
      </style>
  </head>
  <body>
    <p><?php echo $komunikat; ?></p>
    <?php if($kod == OK):?>
    <p>Możesz się <a href='login.php'>zalogować</a>.</p>
    <?php else:?>
    <p>Powrót do 
      <a href='new_user_form.php'>formularza rejestracyjnego</a>.
    </p>
    <?php endif;?>
      
      <div class="workarea">
      
      <h2 style="text-align:center;">Wprowadzone dane:</h2>
      <p>Nazwa: <?php echo $_SESSION['nazwa'] ?></p>
      <p>Haslo: <?php echo $_SESSION['haslo'] ?></p>
      <p>Imie: <?php echo $_SESSION['imie'] ?></p>
      <p>Nazwisko: <?php echo $_SESSION['nazwisko'] ?></p>
      <p>Email: <?php echo $_SESSION['email'] ?></p>
      <p>Avatar: <br/> <?php echo "<img src='".$_SESSION['avatar']."' >"; ?></p>
      </div>
  </body>
<html>