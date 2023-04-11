<!DOCTYPE html>
<html lang="pl-PL">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel klienta</title>

    <link rel="stylesheet" href="../style.css" type="text/css" />

<style>
#panel_kl{

background-color: #1c3253;
color: #fff;
padding: 20px;
text-align: center;


}

</style>


  </head>
  <body>
    <div id="panel_kl">
      <h1>Panel klienta</h1>
    </div>

    <div id="menu">
      <ul>
        <li><a href="my_account.php">Moje konto</a></li>
        <li><a href="customer_panel.php">Moje zamówienia</a></li>
        <li><a href="../main.php" target="_blank">Przejdź do strony sklepu</a></li>
        <li><a href="login.php">Wyloguj</a></li>
        
      </ul>
    </div>

    <div id="content">
      <h2>Moje konto</h2>



<?php
session_start(); // rozpoczyna sesję
require_once('config.php'); // połączenie z bazą danych

if(!isset($_SESSION['email'])) { // sprawdzenie, czy użytkownik jest zalogowany
  header("Location: login.php"); // przekierowanie do strony logowania, jeśli użytkownik nie jest zalogowany
  exit();
}

$email = $_SESSION['email']; // pobranie ID zalogowanego użytkownika z sesji
$sql = "SELECT * FROM  klient  WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) { // sprawdzenie, czy zapytanie zwróciło wyniki
  echo "<table>";
          echo "<tr><th>Imię</th><th>Nazwisko</th><th>Login</th><th>Hasło</th></tr>";
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["imię"] . "</td><td>" . $row["nazwisko"] . "</td><td>" . $row["login"] . "</td><td>" . $row["hasło"] . "</td></tr>";
          }
          echo "</table>";
} else {
  echo "Nie udało się pobrać danych klienta."; // wyświetlenie komunikatu o błędzie, jeśli zapytanie nie zwróciło wyników
  exit();
}

// obsługa formularza
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $imie = $_POST['imie'];
  $nazwisko = $_POST['nazwisko'];
  $login = $_POST['login'];
  $email = $_POST['email'];
  $haslo = $_POST['haslo'];


  // aktualizacja danych klienta w bazie danych
  $query = "UPDATE klient SET imię = '$imie', nazwisko = '$nazwisko', login = '$login' email = '$email', hasło = '$haslo' WHERE email = $user_id";
  $result = mysqli_query($conn, $query); // wykonanie zapytania

  if($result) {
    echo "Dane klienta zostały zaktualizowane."; // wyświetlenie komunikatu o powodzeniu aktualizacji
    $row['imię'] = $imie; // aktualizacja danych klienta w zmiennej $row
    $row['nazwisko'] = $nazwisko;
    $row['login'] = $login;
    $row['email'] = $email;
    $row['haslo'] = $haslo;
    
  } else {
    echo "Nie udało się zaktualizować danych klienta."; // wyświetlenie komunikatu o błędzie
  }

}




mysqli_close($conn); // zamknięcie połączenia z bazą danych
?>

<h2>Zmień Dane</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="imie">Imię:</label>
    <input type="text" name="imie" >
    <label for="nazwisko">Nazwisko:</label>
<input type="text" id="nazwisko" name="nazwisko" >
<label for="login">Login:</label>
<input type="text" id="login" name="login" >

<label for="email">E-mail:</label>
<input type="text" id="email" name="email" >

<label for="haslo">Hasło:</label>
<input type="password" id="haslo" name="haslo">

<input type="submit" value="Zapisz zmiany">

</form>








    </div>
  </body>
</html>
