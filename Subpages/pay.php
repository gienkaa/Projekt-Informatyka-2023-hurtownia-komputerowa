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
  background-color: #1c3253;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
}

</style>

  </head>
  <body>
    <form action="shopping.php" method="post">
      <label for="dostawa">Wybierz opcję dostawy:</label>
      <select name="dostawa" id="dostawa">
        <option value="Kurier">Kurier</option>
        <option value="Paczkomat">Paczkomat</option>
        <option value="Odbiór osobisty">Odbiór osobisty</option>
      </select>

      <label for="platnosc">Wybierz opcję płatności:</label>
<select name="platnosc" id="platnosc">
<option value="Karta">Karta płatnicza</option>
<option value="Przelew">Przelew bankowy</option>
<option value="Gotowka">Płatność gotówką</option>
</select>

<label for="dostawa">Wpisz swój login i hasło:</label><br>
<label for="dostawa">Login:</label><br>
<input type="text" name="login" ><br>
<br>
<label for="dostawa">Hasło:</label><br>
<input type="password" name="haslo" >

<?php
    session_start();
    if(isset($_SESSION['email'])){
      $login = $_SESSION['email'];
      echo "<input type='hidden' name='id_klienta' value='$login'/>";
    }
    else {
      header('Location: login.php');
      exit();
    }
  ?>

  <input type="submit" value="Kupuję" />
</form>

  </body>
</html>