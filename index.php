<?php

session_start();

if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalagowany'] == true))
{
    //header('Location: .php');
    exit();
}

?>

<?php

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
      <link rel="stylesheet" href="style.css" type="text/css" />
  </head>

  <body>

  <form action = "zaloguj.php" method="post">
      login:<input type="text" name="login"/>
      hasło:<input type="password" name="haslo"/> <br/>
      <input type="submit" value="Zaloguj się"/>
  </form>
  <a href="rejestracja.php">Rejestracja</a>

    <div class="container">

      <div class="starter-template">

          <div class="col-sm-12 col-md-4 text-center" style="margin-left: auto; margin-right: auto;">
              <form>
                  <div class="form-group">
                      <input type="text" class="form-control" id="search" placeholder="Szukaj">
                      <button type="submit" class="btn btn-primary">Szukaj</button>
                  </div>
              </form>
          </div>

          <div class="col-7 text-center" style="margin-right: auto; margin-left: auto;">
              <ul class="list-group">
                  <?php
                  foreach ($products as $product) {
                      echo '<div class="card mb-3">';
                      echo '<img style="height: 400px;" class="card-img-top" data-src="' . 'assets/images/' . $product["image"] . '" alt="100%x180" src="' . 'assets/images/' . $product["image"] . '" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">';
                      echo '<div class="card-body">';
                      echo '<h5 class="card-title">' . $product["name"] .'</h5>';
                      echo '<p class="card-text">Producent: ' . $product["brand"] . '</p>';
                      echo '<span class="card-text">Kategoria: ' . $product["category"] . '</span>';
                      echo '<p class="card-text"><small class="text-muted">' . $product["price"] . ' PLN' . '</small></p>';
                      echo '</div>';
                      echo '</div>';
                  }
                  ?>
              </ul>
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