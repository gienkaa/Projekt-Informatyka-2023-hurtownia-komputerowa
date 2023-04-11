<!DOCTYPE html>
<html lang="pl-PL">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css" type="text/css" />
    </head>
<body>
<div id="head_reg">
<h1>Zaloguj się</h1>
</div>
<div id="reg_place">
<!-- Formularz logowania -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <label for="email">Adres email:</label><br>
  <input type="email" name="email" required><br><br>
  <label for="email">Login:</label><br>
  <input type="text" name="login" ><br><br>
  <label for="password">Hasło:</label><br>
  <input type="password" name="password" id="password" required>
  <button type="button" onclick="togglePassword()">Pokaż hasło</button> <br>
    
  <input type="submit" name="submit" value="Zaloguj się"><br>
  <a href="../main.php" ><input type="button" value="Strona główna"></a>


</form>



</div>

<script>
    function togglePassword() {
      var passwordInput = document.getElementById("password");
      var toggleButton = document.querySelector("button[onclick='togglePassword()']");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleButton.textContent = "Ukryj hasło";
      } else {
        passwordInput.type = "password";
        toggleButton.textContent = "Pokaż hasło";
      }
    }
  </script>



<?php

// Początek sesji
session_start();

// Sprawdzenie, czy formularz został przesłany
if(isset($_POST['submit'])) {

  // Połączenie z bazą danych MySQL
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = '';
  $dbname = "hurtownia_komputerowa";
  
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Sprawdzenie, czy połączenie zostało nawiązane
  if(!$conn) {
    die("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
  }

  // Pobranie danych z formularza logowania
  $email = $_POST['email'];
  $password = $_POST['password'];
  $login = $_POST['login'];

  // Sprawdzenie, czy użytkownik o podanym adresie email i haśle istnieje w bazie danych
  $sql = "SELECT * FROM klient WHERE email='$email' AND hasło='$password' AND login='$login'";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);

  if($count > 0) {
    // Użytkownik o podanym adresie email i haśle istnieje w bazie danych
    $_SESSION['email'] = $email;
    header("location: customer_panel.php");
    exit();
  } else {
    // Nie udało się zalogować
    echo "Nie udało się zalogować. Spróbuj ponownie.";
  }

  // Zamknięcie połączenia z bazą danych
  mysqli_close($conn);
}

?>
</body>
</html>





