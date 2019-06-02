<?php
session_start();
require_once "connect.php";

if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']) {
    if ($_SESSION['products']) {
        unset($_SESSION['products']);
    }

    if ($_SESSION['quantity']) {
        unset($_SESSION['quantity']);
    }

    header('Location: index.php');
    exit();
}
?>