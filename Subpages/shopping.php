<!DOCTYPE html>
<html lang="pl-PL">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zakupy</title>
    <style>

body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
}

form {
  max-width: 500px;
  margin: 0 auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 10px;
}

select {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: none;
  border-radius: 5px;
  background-color: #f5f5f5;
}

input[type="submit"] {
  display: block;
  margin: 20px auto 0;
  padding: 10px;
  border: none;
  border-radius: 5px;
  background-color: #4CAF50;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
}

</style>
  </head>
  <body>
    <?php
    // Pobranie danych z formularza
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    $dostawa = $_POST['dostawa'];
    $platnosc = $_POST['platnosc'];

    // Walidacja danych
    if (empty($login) || empty($haslo) || empty($dostawa) || empty($platnosc)) {
        echo "<script>window.alert('Wszystkie pola są wymagane.');</script>";
      exit;
    }

    // Połączenie z bazą danych
    $conn = mysqli_connect("localhost", "root", "", "hurtownia_komputerowa");

    // Sprawdzenie poprawności danych logowania
    $query = "SELECT id_klienta FROM klient WHERE login = '$login' AND hasło = '$haslo'";
    $result = mysqli_query($conn, $query);
    if (!$result || mysqli_num_rows($result) == 0) {
      echo "Niepoprawny login lub hasło.";
      exit;
    }

    // Pobranie id_klienta z bazy
    $row = mysqli_fetch_assoc($result);
    $id_klienta = $row['id_klienta'];


    // data
    $data = date('Y-m-d H:i:s');

      // status
      $status = "złożono zamówienie";

    // Wstawienie zamówienia do bazy danych
    $query = "INSERT INTO zamowienia (id_klienta, dostawa, platnosc,data_zamowienia,status_zamowienia) VALUES ('$id_klienta', '$platnosc','$dostawa','$data','$status')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "<script>window.alert('Błąd podczas wstawiania zamówienia do bazy danych.');</script>";
      exit;
    } 

    // Wyświetlenie potwierdzenia zamówienia
    echo "<script>window.alert('Zamówienie zostało złożone.');</script>";
    header("Location: customer_panel.php");

    ?>

  </body>
</html>
