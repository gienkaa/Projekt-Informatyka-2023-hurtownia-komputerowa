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
        <li><a href="../main.php" target="_blank">Przejdź do strony sklepu</a></li>
        <li><a href="login.php">Wyloguj</a></li>
        
      </ul>
    </div>

    <div id="content">
      <h2>Moje zamówienia</h2>
      <?php
        // Początek sesji
        session_start();

        // Sprawdzenie, czy użytkownik jest zalogowany
        if (!isset($_SESSION['email'])) {
          header("location: login.php");
          exit();
        }

        // Połączenie z bazą danych MySQL
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "hurtownia_komputerowa";

        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        // Sprawdzenie, czy połączenie zostało nawiązane
        if (!$conn) {
          die("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
        }

        // Pobranie zamówień użytkownika
        $login = $_SESSION['email'];
        $sql = "SELECT * FROM zamowienia INNER JOIN klient ON klient.id_klienta=zamowienia.id_klienta WHERE email = '$login'";
        $result = mysqli_query($conn, $sql);

        // Sprawdzenie, czy użytkownik ma jakieś zamówienia
        if (mysqli_num_rows($result) > 0) {
          // Wyświetlenie zamówień
          echo "<table>";
          echo "<tr><th>ID zamówienia</th><th>Data</th><th>Status</th></tr>";
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["id_zamowienia"] . "</td><td>" . $row["data_zamowienia"] . "</td><td>" . $row["status_zamowienia"] . "</td></tr>";
          }
          echo "</table>";
        } else {
          // Brak zamówień
          echo "<p>Nie masz jeszcze żadnych zamówień.</p>";
        }

        // Zamknięcie połączenia z bazą danych
        mysqli_close($conn);
      ?>
    </div>
  </body>
</html>
