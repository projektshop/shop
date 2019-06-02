<?php
session_start();
$dbh = new PDO('mysql:host=localhost;dbname=shop', 'root', '');
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
  if(
          !isset($_SESSION['zalogowany']) ||
          !$_SESSION['zalogowany'] ||
          !$_SESSION['products'] ||
          !$_SESSION['quantity']
  ) {
      header('Location: index.php');
  } else {
      $products = [];
      $cartProducts = implode(',', $_SESSION['products']);

      foreach($dbh->query("SELECT * from products WHERE id IN ({$cartProducts})") as $row) {
          $products[] = $row;
      }
  }
  ?>


  <?php
  if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
  ?>

    <div class="container mt-100">

      <div class="starter-template">

          <div class="col-7 text-center" style="margin-right: auto; margin-left: auto;">
              <h1 class="mb-30">Koszyk</h1>
            <?php
            foreach ($products as $product) {
                echo '<div class="card mb-3 data-id="'.$product["id"].'">';
                    echo '<div class="card-body">';
                echo '<img class="card-img-top cart-preview" data-src="' . 'assets/images/' . $product["image"] . '" alt="100%x180" src="' . 'assets/images/' . $product["image"] . '" data-holder-rendered="true"">';
                    echo '<h5 class="card-title">' . $product["name"] .'</h5>';
                    echo '<p class="card-text">Cena za sztukę: ' . $product["price"] . ' PLN</p>';
                    echo '<p class="card-text">Ilość sztuk: ' . $_SESSION['quantity'][$product['id']] . '</p>';
                    echo '</div>';
                echo '</div>';
            }
            echo '<a href="cart_clear.php" class="btn btn-danger mr-15">Wyczyść koszyk</a>';
            echo '<button class="btn btn-primary">Potwierdź</button>';
            ?>
          </div>

      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
================================================== -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>