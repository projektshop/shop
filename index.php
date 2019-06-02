<?php
session_start();
$dbh = new PDO('mysql:host=localhost;dbname=shop', 'root', '');
$products = [];

foreach($dbh->query('SELECT * from products') as $row) {
    $products[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">


    <title>Sklep butów</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
  </head>

  <body>

  <?php
  if(!isset($_SESSION['zalogowany']) || !$_SESSION['zalogowany']) {
      echo '<form action = "zaloguj.php" method="post">';
      echo 'login:<input type="text" name="login"/>';
      echo 'hasło:<input type="password" name="haslo"/> <br/>';
      echo '<input type="submit" value="Zaloguj się"/>' ;
      echo '</form>';
      echo '<a href="rejestracja.php">Rejestracja</a>';
  } else {
      echo '<a class="btn btn-secondary" href="logout.php">Wyloguj</a>';
  }
  ?>

  <a id="cart-link" class="btn btn-success <?= isset($_SESSION['products']) ? '' : 'hidden' ?>" href="cart.php">Koszyk</a>

  <?php
  if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
  ?>

    <div class="container">

      <div class="starter-template">

          <div class="col-sm-12 col-md-4 text-center" style="margin-left: auto; margin-right: auto;">
              <form>
                  <div class="form-group">
                      <input type="text" class="form-control" id="search" placeholder="Szukaj">
                  </div>
              </form>
          </div>

          <div class="col-7 text-center" style="margin-right: auto; margin-left: auto;">
              <div id="products-list" class="list-group">
                  <?php
                  foreach ($products as $product) {
                      echo '<div class="card mb-3 product" data-name="'.$product["name"].'" data-id="'.$product["id"].'">';
                      echo '<img style="height: 500px;" class="card-img-top" data-src="' . 'assets/images/' . $product["image"] . '" alt="100%x180" src="' . 'assets/images/' . $product["image"] . '" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">';
                      echo '<div class="card-body">';
                          echo '<h5 class="card-title">' . $product["name"] .'</h5>';
                          echo '<p class="card-text">Producent: ' . $product["brand"] . '</p>';
                          echo '<span class="card-text">Kategoria: ' . $product["category"] . '</span>';
                          echo '<p class="card-text"><small class="text-muted">' . $product["price"] . ' PLN' . '</small></p>';
                          echo '<div class="d-flex justify-content-center actions">';
                            echo '<button class="p2 btn btn-success cart-action">Dodaj do koszyka</button>';
                            echo '<input type="number" step="1" min="1" class="p1 form-control quantity" value="0"/>';
                          echo '</div>';
                      echo '</div>';
                      echo '</div>';
                  }
                  ?>
              </div>
          </div>

      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
================================================== -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

  </body>
</html>