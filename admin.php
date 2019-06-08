<?php

session_start();

?>
<?php
if(!isset($_SESSION['zalogowany']) || ($_SESSION['zalogowany'] !== true))
{
    header('Location: index.php');
    exit();
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
    <link rel="stylesheet" href="./assets/css/style.css" type="text/css"/>
    <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        body{
            background-color: white;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-dark bg-dark justify-content-between">
    <a class="navbar-brand">Panel</a>
    <a href="#" onclick="addNewProduct()">Dodaj</a>
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Nazwa" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Szukaj</button>
    </form>
</nav>

<div class="container">

    <div class="row">
        <div class="square col-xs-12 col-sm-9 col-md-6 col-lg-3">
            <a href="#"><h1>Ustawienia</h1></a>
        </div>
        <div class="square col-xs-12 col-sm-9 col-md-6 col-lg-3">
            <a href="users.php"><h1>Użytkownicy</h1></a>
        </div>
        <div class="square col-xs-12 col-sm-9 col-md-6 col-lg-3">
            <a href="products.php"><h1>Produkty</h1></a>
        </div>
    </div>

</div>
</body>
</html>


















