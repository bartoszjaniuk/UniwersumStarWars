<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Rejestracja użytkownika</title>
    <link rel="stylesheet" href="register_style.css">
    <script type="text/javascript">
        
      function sprawdz(){
        var f = document.forms.formularz1;
        var avatar_path = f.avatar.value;

        if(f.nazwa.value.length < 3 || 
           f.nazwa.value.length > 20){
          alert('Nazwa musi mieć od 3 do 20 znaków!');
          return;
        }

        if(f.haslo.value.length < 6 || 
           f.haslo.value.length > 40){
          alert('Hasło musi mieć od 6 do 40 znaków!');
          return;
        }

        if(f.haslo.value != f.haslo2.value) {
          alert('Hasła różnią się od siebie!');
          return;
        }

       if (f.email.value.indexOf("@", 0) < 0)                 
    { 
        window.alert("Proszę podać poprawny adres E-mail"); 
        email.focus();
        return false; 
    } 
   
    if (f.email.value.indexOf(".", 0) < 0)                 
    { 
        alert("Proszę podać poprawny adres E-mail"); 
        return; 
    }
          if (!avatar_path.match(/(?:gif|jpg|png|bmp)$/)) {
    // inputted file path is not an image of one of the above types
    alert("inputted file path is not an image!");
              return;
}

        if(f.imie.value == "" ||
           f.nazwisko.value == "" ||
           f.email.value == "" ||
           f.avatar.value == ""
           
          
           ){
           alert('Proszę wypełnić wszystkie pola formularza!');
           return;
        }
          
     
          
        f.submit();
      }
    </script>
  </head>
  <body>
   <div id="particles-js">
       <div id="container-flex">
           <div class="workarea">
   
   
    <h2> Wprowadź dane rejestracyjne: </h2>
    <form name = "formularz1"
          action = "add_new_user.php" 
          enctype="multipart/form-data"
          method = "post">
          
      <table>
        <tr>
          <td>Nazwa użytkownika:</td>
          <td>
            <input type="text" name="nazwa">
          </td>
        </tr><tr>
          <td>Hasło:</td>
          <td>
            <input type="password" name="haslo">
          </td>
        </tr><tr>
          <td>Powtórz hasło:</td>
          <td>
            <input type="password" name="haslo2">
          </td>
        </tr><tr>
          <td>Imię:</td>
          <td>
            <input type="text" name="imie">
          </td>
        </tr><tr>
          <td>Nazwisko:</td>
          <td>
            <input type="text" name="nazwisko">
          </td>
        </tr><tr>
          <td>E-mail:</td>
          <td>
            <input type="email" name="email">
          </td>
        </tr><tr>
        <td>Avatar:</td>
          <td>
          <input type="file" name="avatar">
          </td>
        </tr><tr>
          <td colspan="2" style="text-align:right;">
            <input class = "register" type="button" value="Rejestracja" 
                   onclick="sprawdz();">
          </td>
        </tr>
      </table>
    </form>
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
