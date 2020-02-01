<?php

if(!isset($_SESSION)) session_start();
  

$host = 'localhost';
$baza = 'starwars';
$uzytkownik = "root";
$haslo = "";
    
$mysqli = new mysqli($host, $uzytkownik, $haslo, $baza) or die (mysqli_error($mysqli));

$update = false;
$id = 0;

$imie = '';
$nazwisko = '';
$rasa = '';
$pozycja = '';
$konflikt = '';
$rodzaj_broni = '';



if(isset($_POST['save'])){
    $imie = $_POST['imie']; 
    $nazwisko = $_POST['nazwisko']; 
    $rasa = $_POST['rasa']; 
    $pozycja = $_POST['pozycja']; 
    $konflikt = $_POST['konflikt']; 
    $rodzaj_broni = $_POST['rodzaj_broni']; 
    
    
    $mysqli->query("INSERT INTO bohater_sw (imie, nazwisko, rasa, pozycja, konflikt, rodzaj_broni) VALUES('$imie', '$nazwisko', '$rasa', '$pozycja', '$konflikt', '$rodzaj_broni')") or die ($mysqli->error);
    
    $_SESSION['message']= "Wiersz został zapisany!";
    $_SESSION['msg_type']= "success";
    
    header("location: main.php");
}


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM bohater_sw WHERE Id_bohater = $id") or die ($mysqli->error());
    
    $_SESSION['message']= "Wiersz został usunięty!";
    $_SESSION['msg_type']= "danger";
    
    header('location: main.php');
}


if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM bohater_sw WHERE Id_bohater = $id") or die ($mysqli->error());
    if(count($result)==1){
        $row = $result->fetch_array();
        $imie= $row['imie'];
        $nazwisko = $row['nazwisko'];
        $rasa = $row['rasa'];
        $pozycja = $row['pozycja'];
        $konflikt = $row['konflikt'];
        $rodzaj_broni = $row['rodzaj_broni'];
        
       
        
    }
}



if(isset($_POST['update'])){
    $id = $_POST['Id_bohater'];
    $imie = $_POST['imie']; 
    $nazwisko = $_POST['nazwisko']; 
    $rasa = $_POST['rasa']; 
    $pozycja = $_POST['pozycja']; 
    $konflikt = $_POST['konflikt']; 
    $rodzaj_broni = $_POST['rodzaj_broni']; 
    
    $mysqli->query("UPDATE bohater_sw SET imie='$imie', nazwisko= '$nazwisko', rasa='$rasa', pozycja='$pozycja', konflikt='$konflikt', rodzaj_broni='$rodzaj_broni' WHERE Id_bohater =$id") or die ($mysqli->error());
    
    $_SESSION['message'] = "Wiersz został zaktualizowany!";
    $_SESSION['msg_type'] = "warning";
    
    header('location: main.php');
    
    
}

?>