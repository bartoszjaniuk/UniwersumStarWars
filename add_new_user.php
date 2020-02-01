<?php
  session_start();
  
  include 'constants.php';

  $host = 'localhost';
  $baza = 'starwars';
  $uzytkownik = "root";
  $haslo = "";

  function addUser($nazwa, $pass, $pass2, $imie, $nazwisko, $email, $avatar){
    //Umożliwienie odwołań do zmiennych globalnych
    global $host, $baza, $uzytkownik, $haslo, $avatar;

    //Sprawdzenie poprawności danych (długość).
    //Dla kodowania jednobajtowego
    //$userPassLength = strlen($pass);
    //Dla kodowania utf-8
    //$userPassLength = strlen(utf8_decode($pass));
    //lub:
    $userPassLength = mb_strlen($pass, 'UTF-8');

    //Zła długość hasła
    if($userPassLength < 6 || $userPassLength > 40){
      return INVALID_USER_PASS;
    }
    
    //Powtórzenie hasła różne od oryginału
    if($pass != $pass2){
      return PASSWORDS_DO_NOT_MATCH;
    }

    if($imie == "" || $nazwisko == ""){
      return EMPTY_FIELDS;
    }

    //Sprawdzenie poprawności danych (wyrażenia regularne)
    if(!preg_match("/^[a-zA-Z0-9_.]{3,20}$/", $nazwa)){
      return INVALID_USER_NAME;
    };
    
    //Tutaj ewentualne dalsze instrukcje weryfikujące dane



    //Nawiązanie połączenia z bazą danych
    $db_obj = new mysqli($host, $uzytkownik, $haslo, $baza);
    if($db_obj->connect_errno){
      //echo 'Wystąpił błąd podczas próby połączenia z serwerem MySQL...';
      //echo $db_obj->connect_error;
      return SERVER_ERROR;
    }

    //Zabezpieczenie znaków specjalnych w parametrach
    $nazwa = $db_obj->real_escape_string($nazwa);
    $pass = $db_obj->real_escape_string($pass);
    $imie = $db_obj->real_escape_string($imie);
    $nazwisko = $db_obj->real_escape_string($nazwisko);
    $email = $db_obj->real_escape_string($email);
    $avatar = $db_obj->real_escape_string('images/'.$_FILES['avatar']['name']);
    

    if(preg_match("!image!", $_FILES['avatar']['type'])){
         
      //copy image to images/ folder
      
      if(copy($_FILES['avatar']['tmp_name'], $avatar)){
        $_SESSION['nazwa'] = $nazwa;  
        $_SESSION['avatar'] = $avatar;  
   
      }
      else{
          $_SESSION['message'] = "Wgrywanie pliku nie powiodło się..";
      }
  }



    //Sprawdzenie, czy użytkownik o podanej nazwie istnieje w bazie.
    $query = "SELECT COUNT(*) FROM users WHERE Nazwa='$nazwa' ";

    if(!$result = $db_obj->query($query)){
      //echo 'Wystąpił błąd: nieprawidłowe zapytanie...';
      $db_obj->close();
      return SERVER_ERROR;
    }

    if(!$row = $result->fetch_row()){
      //echo('Wystąpił błąd: nieprawidłowe wyniki zapytania...');
      $db_obj->close();
      return SERVER_ERROR;
    }
    else{
      //Użytkownik istnieje, nie można dodać nowego wpisu do bazy.
      if($row[0] > 0){
        $db_obj->close();
        return USER_NAME_ALREADY_EXISTS;
      }
    }
    
    //Dodanie nowego użytkownika

    
    $query = "INSERT INTO users VALUES(";
    $query .= "NULL, '$nazwa', '$pass', '$imie', '$nazwisko', '$email', '$avatar')";

    if(!$result = $db_obj->query($query)){
      //echo('Wystąpił błąd: instrukcja INSERT...');
      $db_obj->close();
      return SERVER_ERROR;
    }

    //Pobranie liczby dodanych rekordów
    $count = $db_obj->affected_rows;

    if($count <> 1){
      //Niewłaściwe wyniki zapytania
      $db_obj->close();
      return SERVER_ERROR;
    }
    else{
      //Prawidłowe dodanie rekordu
      $db_obj->close();
      return OK;
    }    
  }
  
  //Sprawdzenie, czy użytkownik jest już zalogowany.
  if(isset($_SESSION['zalogowany'])){
    header("Location: main.php");
  }
  //Sprawdzenie, czy zostały przekazane wszystkie pola formularza.
  else if(!isset($_POST["nazwa"]) || !isset($_POST["haslo"]) ||
          !isset($_POST["haslo2"]) || !isset($_POST["imie"]) ||
          !isset($_POST["nazwisko"]) || !isset($_POST["email"])){
    header('Location:new_user_form.php');
  }
  else{
    //Odczytanie danych z formularza
    $nazwa = $_POST["nazwa"];
    $pass = $_POST["haslo"];
    $pass2 = $_POST["haslo2"];
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $avatar = $_POST["avatar"];

    //Wywołanie funkcji rejestrującej nowego użytkownika
    $val = addUser($nazwa, $pass, $pass2, $imie, $nazwisko, $email, $avatar);

    //Reakcja na wartość zwróconą przez funkcję
    switch($_SESSION['kod'] = $val){
      case OK :
        $_SESSION['komunikat'] = "Rejestracja poprawna.";
        break;
      case INVALID_USER_NAME :
        $_SESSION['komunikat'] = 
          "Nazwa użytkownika musi mieć od 3 do 20 znaków i " .
          "może zawierać jedynie znaki alfabetu łacińskiego " . 
          "oraz cyfry i znaki podkreślenia.";
        break;
      case INVALID_USER_PASS :
        $_SESSION['komunikat'] = "Hasło musi mieć od 6 do 40 znaków.";
        break;
      case USER_NAME_ALREADY_EXISTS :
        $_SESSION['komunikat'] = 
          "Użytkownik $nazwa jest już zarejestrowany.";
        break;
      case EMPTY_FIELDS :
        $_SESSION['komunikat'] = 
          "Proszę wypełnić wszystkie wymagane pola formularza.";
        break;
      case PASSWORDS_DO_NOT_MATCH :
        $_SESSION['komunikat'] = 
          "Wpisane hasła różnią się.";
        break;
      default:
        $_SESSION['komunikat'] = 
          "Błąd serwera. Rejestracja nie powiodła się.";
    }
    $_SESSION['nazwa'] = $nazwa;
    $_SESSION['haslo'] = $pass;
    $_SESSION['imie'] = $imie;
    $_SESSION['nazwisko'] = $nazwisko;
    $_SESSION['email'] = $email;
    $_SESSION['avatar'] = $avatar;
    header('Location: after_registration.php');
  }
?>
