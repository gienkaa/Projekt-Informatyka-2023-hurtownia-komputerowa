<html>
  <head>
    <title>Moje zamówienia</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <header>
      <nav>
        <ul>
        <li><a href="my_account.php">Moje konto</a></li>
        <li><a href="customer_panel.php">Moje zamówienia</a></li>
        <li><a href="../main.php" target="_blank">Przejdź do strony sklepu</a></li>
        <li><a href="login.php">Wyloguj</a></li>
        </ul>
      </nav>
    </header>
    <main>
    <?php

// Początek sesji
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if(!isset($_SESSION['email'])) {
  // Jeśli użytkownik nie jest zalogowany, przekieruj go do strony logowania
  header("Location: login.php");
  exit();
}

// Połączenie z bazą danych MySQL
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "hurtownia_komputerowa";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Sprawdzenie, czy połączenie zostało nawiązane
if(!$conn) {
  die("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
}

// Pobranie zamówień użytkownika
$user_id = $_SESSION['id_klienta'];
$sql = "SELECT * FROM zamówienia WHERE id_klienta='$user_id'";
$result = mysqli_query($conn, $sql);

?>

<!-- Wyświetlenie zamówień w tabeli -->
<h1>Twoje zamówienia</h1>
<table>
  <tr>
    <th>ID zamówienia</th>
    <th>Data zamówienia</th>
    <th>Produkt</th>
    <th>Cena</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['id_zamowienia']; ?></td>
      <td><?php echo $row['data']; ?></td>
      <td><?php echo $row['status']; ?></td>
      <td><?php echo $row['platnosc']; ?></td>
      <td><?php echo $row['dostawa']; ?></td>
      
    </tr>
  <?php } ?>
</table>

<?php

// Zamknięcie połączenia z bazą danych
mysqli_close($conn);

?>
</main>
  </body>
</html>





