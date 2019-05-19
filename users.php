<?php

session_start();

?>
<?php
if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
{
    header('Location: index2.php');
    exit();
}

?>
<?php

$dbh = new PDO('mysql:host=localhost;dbname=shop', 'root', '');
$products = [];

foreach($dbh->query('SELECT * from users') as $row) {
    $users[] = $row;
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
    <link rel="stylesheet" href="./style.css" type="text/css" />
</head>

<body>

<form action = "zaloguj.php" method="post">
    login:<input type="text" name="login"/>
    hasło:<input type="password" name="haslo"/> <br/>
    <input type="submit" value="Zaloguj się"/>
</form>

<?php
if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>





<div class="container">

    <div class="starter-template">

        <div class="col-sm-12 col-md-4 text-center" >
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" id="search" placeholder="Szukaj">
                    <button type="submit" class="btn btn-primary">Szukaj</button>
                </div>
            </form>
        </div>

        <div class="list-content text-center" >
            <ul class="list-group">
                <?php
                foreach ($users as $user) {
                    ?>
                    <li class="col-sm-12 col-md-10 list-group-item text-left" style="color:black;list-style-type: none;margin-bottom: 10px">
                        <label style="margin-right: 10px"><?php echo $user["id"]?></label>
                        <label style="margin-right: 10px"><?php echo $user["email"]?></label>
                        <label style="margin-right: 10px"><?php echo $user["username"]?></label>
                        <label style="margin-right: 10px"><?php echo $user["address"]?></label>
                                             <label >
                                          <button  class="btn btn-danger delBtn btn-xs"  >DELETE</button>
                        </label>
                    </li>
                    <?php
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

