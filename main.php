<?php
session_start();

if(!isset($_SESSION['zalogowany'])){
  $_SESSION['komunikat'] = "Nie jesteś zalogowany!";
  header("Location: login.php");
  exit();
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Główna część serwisu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="main_style.css">
    
  </head>
  <body>
   
   
    <div id="topDiv" class="scafoldingDiv">
      <div id="headerMainDiv">
         <p>Jesteś zalogowany jako: <?=$_SESSION['zalogowany']?></p>
      </div>
      <div id="headerUserInfoDiv">
        <p><a class="logOUT" href="logout.php">Wylogowanie</a></p>
      </div>
    </div>
   
   
  
    
    
    
    <?php require_once 'process.php'; ?>
    
    <?php 
      
      if(isset($_SESSION['message'])): ?>
      <div class="alert alert-<?=$_SESSION['msg_type']?>">  
    
    <?php
    echo $_SESSION['message'];
           unset($_SESSION['message']);
    ?>
      </div>
      <?php endif ?>
    
    <div class="container">
<?php
      
$host = 'localhost';
$baza = 'starwars';
$uzytkownik = "root";
$haslo = "";
    
$mysqli = new mysqli($host, $uzytkownik, $haslo, $baza) or die (mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM bohater_sw") or die ($mysqli->error);
//pre_r($result);
?>

      
<div class="row justify-content-center">
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Imie</th>
                <th>Nazwisko</th>
                <th>Rasa</th>
                <th>Pozycja</th>
                <th>Konflikt</th>
                <th>Rodzaj Broni</th>
                <th colspan="2">Akcja</th>
            </tr>
        </thead>
        <?php
        while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['Id_bohater']; ?></td>
            <td><?php echo $row['imie']; ?></td>
            <td><?php echo $row['nazwisko']; ?></td>
            <td><?php echo $row['rasa']; ?></td>
            <td><?php echo $row['pozycja']; ?></td>
            <td><?php echo $row['konflikt']; ?></td>
            <td><?php echo $row['rodzaj_broni']; ?></td>
            <td>
                <a href="main.php?edit=<?php echo $row['Id_bohater']; ?>"
                class = "btn btn-info">Edytuj</a>
                <a href="process.php?delete=<?php echo $row['Id_bohater']; ?>"
                class = "btn btn-danger">Usuń</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
      
            
                        
<?php      
      function pre_r($array){
    echo'<pre>';
    print_r($array);
    echo'</pre>';
}
    
      
?>
    
    
    
    
        <div id="container-flex">
           <div class="workarea">
    <div class="row justify-content-center">
    <form action="process.php" method="post">
       <input type="hidden" name="Id_bohater" value="<?php echo $id; ?>">
        <div class="form-group">
            <label>Imie</label>
            <input type="text" name="imie" value="<?php echo $imie?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Nazwisko</label>
            <input type="text" name="nazwisko" value="<?php echo $nazwisko?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Rasa</label>
            <input type="text" name="rasa" value="<?php echo $rasa?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Pozycja</label>
            <input type="text" name="pozycja" value="<?php echo $pozycja?>" class="form-control" >
        </div>
        <div class="form-group">
            <label>Konflikt</label>
            <input type="text" name="konflikt" value="<?php echo $konflikt?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Broń</label>
            <input type="text" name="rodzaj_broni" value="<?php echo $rodzaj_broni?>" class="form-control">
        </div>
        <div class="form-group">
           <?php
            if($update == true): ?>
                   
                <button type="submit" class="btn btn-info" name="update">Zaktualizuj</button>
            <?php else: ?>
            <button type="submit" class="btn btn-primary" name="save">Zapisz</button>
            <?php endif; ?>
        </div>
    </form> 
    </div>
    
</div>
        </div>
      
  </body>
</html>
