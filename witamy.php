<?php


session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalagowany'] == true)) {
    header('Location: index2.php');
    exit();
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <title> zalogowany</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" href="style.css" type="text/css"/>


</head>

<body>


Dziękujemy za rejestrację w serwisie!<br />
Proszę sprawdzic mail w celu aktywacji konta <br /> <br />
Bez aktywacji konta nie będzie możliwości zalogowania się do serwisu.



<a href="index.php">Zaloguj się na swoje konto!</a>
<br /><br />


</body>


</html>