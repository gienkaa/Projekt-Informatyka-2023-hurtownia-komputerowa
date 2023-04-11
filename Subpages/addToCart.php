<?php
session_start();

// Połączenie z bazą danych
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "hurtownia_komputerowa";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
  die("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
}

// Pobranie id produktu z żądania POST
$id = $_POST['id'];

// Zapytanie SQL pobierające produkt o podanym id
$sql = "SELECT * FROM magazyn WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
// sprawdzenie, czy zapytanie się udało
if (!$result) {
  die("Nie udało się pobrać produktu z bazy danych: " . mysqli_error($conn));
  }
  
  // Pobranie wyników zapytania i zapisanie ich do zmiennej $row
  $row = mysqli_fetch_assoc($result);
  
  // Sprawdzenie, czy w sesji istnieje zmienna koszyk
  if (!isset($_SESSION['koszyk'])) {
  // Jeśli nie, utworzenie pustej tablicy koszyka
  $_SESSION['koszyk'] = array();
  }
  
  // Dodanie produktu do koszyka
  array_push($_SESSION['koszyk'], $row);
  
  // Zamknięcie połączenia z bazą danych
  mysqli_close($conn);
  ?>
  <p>Produkt został dodany do koszyka.</p>