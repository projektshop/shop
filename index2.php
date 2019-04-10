 <?php

session_start();

 if ((!isset($_SESSION['zalogowany'])) || (!isset($_SESSION['zalogowany'])))
 {
     header('Location: index.php');
     exit();
 }

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset = "utf-8" />
<title> zalogowany</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
<link rel="stylesheet" href="style.css" type="text/css" />


</head>

<body>


<H1> ZALOGOWANY </H1>


</body>


</html>