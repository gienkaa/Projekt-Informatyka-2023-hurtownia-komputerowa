<?php

// Dane połączenia z bazą danych
define('DB_HOST', 'localhost');  // adres serwera MySQL
define('DB_USER', 'root');       // nazwa użytkownika MySQL
define('DB_PASS', '');           // hasło użytkownika MySQL
define('DB_NAME', 'hurtownia_komputerowa');      // nazwa bazy danych MySQL

// Nawiązanie połączenia z bazą danych
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Sprawdzenie, czy udało się nawiązać połączenie z bazą danych
if (!$conn) {
    die("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
}

?>
