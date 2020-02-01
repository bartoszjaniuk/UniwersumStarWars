<?php
  if(isset($_SESSION['komunikat'])){
    $komunikat = $_SESSION['komunikat'];
    unset($_SESSION['komunikat']);
  }
  else{
    $komunikat = "Wprowadź nazwę i hasło użytkownika:";
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="login_style.css">
  </head>
  <body>
   <div id="particles-js">
       <div id="container-flex">
           <div class="workarea">
    <div>
      <div style="font-size: 25px;">
        <?=$komunikat?>
      </div>
      <br/>
      <form action = "http://localhost/PROJEKT/login.php"
            method = "POST">
        <table>
          <tr>
            <td>Użytkownik:</td>
            <td>
              <input type="text" name="user">
            </td>
          </tr><tr>
            <td>Hasło:</td>
            <td>
              <input type="password" name="haslo">
            </td>
            </tr><tr>
            <td>
              <a class="register" href="new_user_form.php">Rejestracja</a>
            </td>
            <td style="text-align:right;">
              <input class="login" type="submit" value="Zaloguj">
            </td>
          </tr>
        </table>
      </form>
    </div>
    </div>
       </div>
      </div>
      <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
     <script>
    particlesJS.load('particles-js', 'particles.json', function(){
      console.log('particles.json loaded...');
    });
  </script>
  </body>
</html>