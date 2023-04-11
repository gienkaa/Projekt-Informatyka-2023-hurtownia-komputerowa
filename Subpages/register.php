
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

<h1>Zarejestruj się</h1>
</div>

<div id="reg_place">


<!-- Formularz rejestracji -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <label for="name">Imię:</label><br>
  <input type="text" name="name" required><br>
  <label for="surname">Nazwisko:</label><br>
  <input type="text" name="surname" required><br>
  <label for="username">Nazwa użytkownika:</label><br>
  <input type="text" name="username" required><br>
  <label for="email">Adres email:</label><br>
  <input type="email" name="email" required><br>
  <label for="password">Hasło (przynajmniej 8 znaków, co najmniej 1 duża litera i 1 cyfra):</label><br>
  <div>
    <input type="password" name="password" id="password" required>
    <button type="button" onclick="togglePassword()">Pokaż hasło</button>
  </div>
  <label for="password_confirm">Powtórz hasło:</label><br>
  <input type="password" name="password_confirm" required><br>
  <input type="submit" name="submit" value="Zarejestruj się">
</form>

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


</div>



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

  // Pobranie danych z formularza rejestracji
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];

  // Sprawdzenie, czy użytkownik o podanym adresie email już istnieje w bazie danych
  $sql = "SELECT * FROM klient WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);

  if($count > 0) {
    // Użytkownik o podanym adresie email już istnieje w bazie danych
    echo "Użytkownik o podanym adresie email już istnieje w bazie danych.";
  } else if ($password != $password_confirm) {
    // Hasła nie są identyczne
    echo "Hasła nie są identyczne. Spróbuj ponownie.";
  } else if(strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password)) {
    // Hasło nie spełnia wymagań
    echo "Hasło powinno mieć przynajmniej 8 znaków, zawierać co najmniej jedną dużą literę oraz jedną cyfrę.";
  } else {
    // Dodanie użytkownika do bazy danych
    $sql = "INSERT INTO klient (login,hasło,email,imię,nazwisko) VALUES ('$username','$password', '$email', '$name', '$surname')";
    if(mysqli_query($conn, $sql)) {
      $_SESSION['message'] = "Rejestracja przebiegła pomyślnie. Możesz się teraz zalogować.";
      header("location: login.php");
      exit();
    } else {
      echo "Wystąpił problem podczas rejestracji: " . mysqli_error($conn);
    }
  }

  // Zamknięcie połączenia z bazą danych
  mysqli_close($conn);
}

?>




</body>

</html>