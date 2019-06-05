<?php
session_start();

if(isset($_POST['email'])) {
    $wszystko_OK = true;
//sprawdzenie usernama
    $username = $_POST['username'];
    $address= $_POST['address'];
//sprawdzenie dlugosci usernama
    if ((strlen($username) < 3) || (strlen($username) > 20)) {
        $wszystko_OK = false;
        $_SESSION['e_username'] = "imie musi posiadać od 3 do 20 znaków!";

    }
    /*
        if (ctype_alnum($username) == false) {
            $_wszystko_OK = false;
            $_SESSION['e_username'] = "username może skladać się tylko z liter i cyfr bez polskich znaków";
        }
    */
    if (isset($_POST['email'])) {
        $wszystko_OK = true;


        // sprawdz poprawność e-mail
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $email)) {
            $wszystko_OK = false;
            $_SESSION['e_email'] = "Podaj poprawny format mail";
        }

        // sprawdz poprawność hasla
        $haslo1 = $_POST['haslo1'];
        $haslo2 = $_POST['haslo2'];


        If((strlen($haslo1)<=2) || (strlen($haslo1>20)))
        {
            $wszystko_OK=false;
            $_SESSION['e_haslo']="haslo moze miec od 2 do 20 znaków";
        }
        if($haslo1!=$haslo2)
        {
            $wszystko_OK=false;
            $_SESSION['e_haslo']="Podane hasła nie są identyczne";
        }

        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
        //echo $haslo_hash; exit(); - do sprawdzenia hashu hasła

        if (!isset($_POST['regulamin'])) {
            $wszystko_OK = false;
            $_SESSION['e_regulamin'] = "Zaakceptuj regulamin";
        }

        //recatpcha
        /*$sekret = "6Lea_BkUAAAAAAd4o3pssteWZ_pvKjSVNHZYqdCN"; // podmieniony

        $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

        $odpowiedz = json_decode($sprawdz);

        if($odpowiedz -> success==false)
        {
        $wszystko_OK=false;
        $_SESSION['e_bot']="potwierdź ze nie jesteś z metalu (lub nie jesteś botem) :)";
        }

        */
        require_once "connect.php";  // zmienic przy publikacji domeny

        mysqli_report(MYSQLI_REPORT_STRICT); //zamiast warningow to wyjatki rzucamy w ostrzezeniach

        try {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno != 0) {
                throw new Exception(mysqli_connect_errno());
            } else {
                //czy email juz istnieje
                $rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");

                if (!$rezultat) throw new Exception($polaczenie->error);

                $ile_takich_maili = $rezultat->num_rows;

                if ($ile_takich_maili > 0) {
                    $wszystko_OK = false;
                    $_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu mail :/";
                }

                //czy nick juz istnieje
                $rezultat = $polaczenie->query("SELECT id FROM users WHERE username='$username'"); //???

                if (!$rezultat) throw new Exception($polaczenie->error);

                $ile_takich_nickow = $rezultat->num_rows;

                if ($ile_takich_nickow > 0) {
                    $wszystko_OK = false;
                    $_SESSION['e_username'] = "Istnieje już user o takim nicku :/, wybierz inny";
                }

                $klucz = md5(mt_rand()); // generuje klucz random lub md5($_POST['nick'] + microtime())

                if ($wszystko_OK == true) {
                    //wszystkie testy zakończone, dodajemy usera do bazy

                    if ($polaczenie->query("INSERT INTO users(email, username, password,address, role) VALUES ( '$email', '$username', '$haslo_hash', '$address' ,'user')")) {
                        $_SESSION['udanarejestracja'] = true;
                        header('Location: witamy.php');
                        require 'PHPMailer/PHPMailerAutoload.php';


                        $mail = new PHPMailer;

                        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'mail.k.lapy.pl';                    // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'sdkfjsa@wo.pl';                 // SMTP username
                        $mail->Password = '****';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to

                        $mail->setFrom('noreplay@k.lapy.pl', 'Mailer');
                        $mail->addAddress($email, $username);     // Add a recipient // tu zmienialem
                        $mail->addAddress();               // Name is optional
                        $mail->addReplyTo('g8824@wp.pl', 'Information');
                        $mail->addCC('cc@example.com');
                        $mail->addBCC('bcc@example.com');

                        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                        $mail->isHTML(true);                                  // Set email format to HTML

                        $mail->Subject = 'Rejestracja sklep';
                        $mail->Body = 'Gratuluje zostales zarejestrowany:) <b> !!!!! </b> <br/>
							twoj klucz to:' . $klucz . '<br/>
							Prosze wprowadz klucz na stronie: 
							http://www.k.lapy.pl/klucz.php?email=' . $email . '&klucz=' . $klucz;
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        //	('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

                        if (!$mail->send()) {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            echo 'Message has been sent';
                        }


                    } else {
                        throw new Exception($polaczenie->error);
                    }
                }


                $polaczenie->close();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            echo '<span style="color; red;">Blad serwera (serwer error), prosimy o rejestracje w innym czasie" </span>';
        }

        //echo '<br /> Informacja developerska;'.$e; // pozniej do wykreślenia


    }
}
?>

<!DOCTYPE HTML>

<html lang="pl">

<head>
    <meta charset="utf-8"/>
    <meta http=equiv="X-UA-Compatible" content=IE=edge, chrome=1"/>
    <title> rejestracja </title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
    <style>

        .error
        {
            color:red;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        form{
            position: absolute;
            top: 100px;
            left:40%;
        }
    </style>


</head>


<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Rejestracja</h5>
<form method="post">
    <div class="form-label-group">
    Name: <br/> <input type="text" name="username" class="form-control"/>  <br/>
    </div>
        <?php

    if(isset($_SESSION['e_username']))
    {
        echo'<div class="error">'.$_SESSION['e_username'].'</div>';
        unset($_SESSION['e_username']);
    }

    ?>
    <div class="form-label-group">
    E-mail: <br/> <input type="text" name="email" class="form-control"/>  <br/>
    </div>

    <?php

    if(isset($_SESSION['e_email']))
    {
        echo'<div class="error">'.$_SESSION['e_email'].'</div>';
        unset($_SESSION['e_email']);
    }

    ?>

    <div class="form-label-group">
    Password: <br/> <input type="password" name="haslo1" class="form-control" /> <br/>
    </div>
    <?php

    if(isset($_SESSION['e_haslo']))
    {
        echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
        unset($_SESSION['e_haslo']);
    }

    ?>
    <div class="form-label-group">
    Powtorz Password: <br/> <input type="password" name="haslo2" class="form-control" /> <br/>
    </div>
    <div class="form-label-group">
    Address: <br/> <input type="text" name="address" class="form-control"/> <br />
    </div>
    <label>
        <input type="checkbox" name="regulamin" class="form-control"/> Akceptuje regulamin </label>

    <?php

    if(isset($_SESSION['e_regulamin']))
    {
        echo'<div class="error">'.$_SESSION['e_regulamin'].'</div>';
        unset($_SESSION['e_regulamin']);
    }

    ?>
    <!--
	<div class="g-recaptcha" data-sitekey="6Lea_BkUAAAAACbNRwhbpqjCmKQxzu2cxCZ_63cg"></div>

	<?php

    if(isset($_SESSION['e_bot']))
    {
        echo'<div class="error">'.$_SESSION['e_bot'].'</div>';
        unset($_SESSION['e_bot']);
    }

    ?>
-->
    <br/>
    <input type="submit" value="Zarejestruj sie" class="btn  btn-primary"/>

</form>
                    <div class="card-body">
              </div>
          </div>
    </div>
</div>
</body>

</html>