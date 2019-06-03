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
$users = [];

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
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
    <style>
        body{
            background-color: white;
        }
    </style>
</head>

<body>


<?php
if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>


<nav class="navbar navbar-dark bg-dark justify-content-between">
    <a class="navbar-brand">Panel</a>
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Nazwa" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Szukaj</button>
    </form>
</nav>


<div class="container">

    <div class="list-content text-center" >
        <form name="x" method="post" action="#" >
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
                            <button name="delBtn" class="btn btn-danger delBtn btn-xs" value="<?= $user["id"]?>" >DELETE</button>
                        </label>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </form>
    </div>

</div>

</div><!-- /.container -->
<?php
if(isset($_POST['delBtn'])) {
    $id = $_POST["delBtn"];

    try {
        $conn = new PDO('mysql:host=localhost;dbname=shop', 'root', '');
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $image_name = $conn->prepare("SELECT image FROM products WHERE id = ?");
        $image_name->execute([$id]);
        $temp = $image_name->fetchColumn();

        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    header("Refresh:0");
}

?>



<!-- Bootstrap core JavaScript
================================================== -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

