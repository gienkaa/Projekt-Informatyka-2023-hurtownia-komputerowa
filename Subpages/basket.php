<!DOCTYPE html>
<html lang="pl-PL">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Hurtownia internetowa zajmująca się sprzedarzą detaliczną urządzeń elektronicznych oraz akcesoriów"
    />
    <meta
      name="keywords"
      content="hurtownia,sklep,komputery,laptopy,akcesoria,myszka,klawiatura,komputerowy,elektroniczny,online"
    />
    <link rel="apple-touch-icon" sizes="60x60" href="./apple-touch-icon.png" />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="./favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="./favicon-16x16.png"
    />
    <link rel="manifest" href="./site.webmanifest" />
    <link rel="mask-icon" href="./safari-pinned-tab.svg" color="#5bbad5" />
    <meta name="msapplication-TileColor" content="#da532c" />
    <meta name="theme-color" content="#ffffff" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap"
      rel="stylesheet"
    />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="script/menu.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/svgs/fi-list.svg'>
<link rel="stylesheet" type="text/css" href="../style.css" />
    
    <title>KompShop</title>


  </head>
  <body>
  <div class="basket_head">
<h1>Koszyk</h1>
</div>
<div class="basket">


  <?php
session_start();

if (isset($_SESSION['koszyk'])) {
  $koszyk = $_SESSION['koszyk'];
  
  // Przetwarzaj żądania usuwania produktu z koszyka
  if (isset($_POST['usun'])) {
    $indeks = $_POST['indeks'];
    unset($koszyk[$indeks]);
    $_SESSION['koszyk'] = $koszyk;
  }
  
  // Wyświetl zawartość koszyka i oblicz całkowitą kwotę produktów
  $calkowita_kwota = 0;
  foreach ($koszyk as $indeks => $produkt) {
    $calkowita_kwota += $produkt['cena'];
    echo $produkt['producent'] . " - " . $produkt['model'] . " - " . $produkt['cena'] ." zł";
    
    // Dodaj formularz usuwania produktu
    echo "<form method='post'>";
    echo "<input type='hidden' name='indeks' value='$indeks'>";
    echo "<input type='submit' name='usun' value='Usuń'>";
    echo "</form>";
  }
  
  // Wyświetl całkowitą kwotę koszyka
  echo "Całkowita kwota: $calkowita_kwota zł.<br>";
  echo "<a href='pay.php'>";
  echo "<input type='submit' value='Zamów'>";
  echo "</a>";
  echo "<a href='../main.php'>";
  echo "<input type='button' value='Strona główna'>";
  echo "</a>";
} else {
  echo "Twój koszyk jest pusty.";
}
?>
</div>

</body>


</html>