<?php

	session_start();
	
	if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Error".$polaczenie->connect_errno. "opis:".$polaczenie->connect_error; // potem do wyrzucenia od opis
		
	}
	else
		{
			
			$login = $_POST['login'];
			$haslo = $_POST ['haslo'];
			//$aktiv = $_POST['role'];
			
			$login = htmlentities($login, ENT_QUOTES, "UTF-8"); // funckcja bezpieczenstwa
			$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8"); // funckcja bezpieczenstwa //niepotrzebne bo zahaszowane
	
			
			
			if($rezultat = @$polaczenie->query(
			sprintf("SELECT * FROM users WHERE username='%s'", // AND role=0, //??? dopisane do  weryfikacji konta aktiv
			mysqli_real_escape_string($polaczenie,$login))))   // funckcja bezpieczenstwa
			//mysqli_real_escape_string($polaczenie,$haslo))))	// funckcja bezpieczenstwa// hashowanie
			{
				$ilu_userow = $rezultat->num_rows;
				if($ilu_userow>0)
				{
					$wiersz = $rezultat->fetch_assoc();
					if(password_verify($haslo, $wiersz['password']))
					{
					
						$_SESSION['zalogowany']= true;
						$_SESSION['id'] = $wiersz['id'];
						$_SESSION['login'] = $wiersz['username'];
						$_SESSION['email'] = $wiersz['email'];
						//$_SESSION['aktiv'] = $wiersz['role']; // dopisane do aktiv konto
						
						//echo user;
						unset($_SESSION['blad']);
						$rezultat->free_result();
						echo "udało sie";
						header('Location: index2.php'); // lokalizacja strony index2.php
					}
					else
					{
						$_SESSION['blad'] = '<span style = "color:red"> NNNieprawidlowy login, haslo lub brak aktywacji konta!
                        </span>';
						header('Location: index.php');
						echo "login : ".$_SESSION['login'];
						echo "haslo : ".$_SESSION['haslo'];
					}
				}
				else
				{
					$_SESSION['blad'] = '<span style = "color:red"> Nieprawidlowy login, haslo lub brak aktywacji konta!</span>';
					header('Location:index.php');
				}
			}



		$polaczenie->close();
		}

?>