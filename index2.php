<?php

session_start();

if ((!isset($_SESSION['zalogowany'])) || (!isset($_SESSION['zalogowany'])))
{
    header('Location: index.php');
    exit();
}
$getuser= $_SESSION["id"];
$conn = new PDO('mysql:host=localhost;dbname=shop', 'root', '');
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$newuser = $conn->prepare("SELECT username,email, address FROM users WHERE id = ?");
$newuser->execute([$getuser]);
$temp = $newuser->fetch();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset = "utf-8" />
    <title> zalogowany</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
</head>

<body>


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Twoje dane</h5>
                    <form class="form-signin" method="post" >
                        <div class="form-label-group">

                            <input type="text" id="email" name="username" class="form-control" value='<?php echo $temp["username"] ?>'  />
                        </div>
                        <br />
                        <div class="form-label-group">

                            <input type="password" id="pswd" name="pswd" class="form-control" placeholder="Password" value=""/>
                        </div>
                        <br />
                        <div class="form-label-group">

                            <input type="text" id="email" name="email" class="form-control" value='<?php echo $temp["email"] ?>'/>
                        </div>
                        <br />
                        <div class="form-label-group">
                            <input id="address" class="form-control" value='<?php echo $temp["address"] ?>' />
                        </div>
                        <br />
                        <div class="form-label-group">
                            <button id="submitBtn" type="submit" class="btn  btn-primary" >Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


</html>