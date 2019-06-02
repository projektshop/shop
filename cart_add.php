<?php
	session_start();
    require_once "connect.php";
	
	if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'])
	{
        $connection = @new mysqli($host, $db_user, $db_password, $db_name);

        if($connection->connect_errno!=0)
        {
            echo "Error".$connection->connect_errno. "opis:".$connection->connect_error; // potem do wyrzucenia od opis

        }
        else {
            if (empty($_SESSION['products'])) {
                $_SESSION['products'] = [];
            }
            $_SESSION['products'][] = $_POST['product'];
            $_SESSION['products'] = array_unique($_SESSION['products']);

            if (empty($_SESSION['quantity'])) {
                $_SESSION['quantity'] = [];
            }
            if (empty($_SESSION['quantity'][$_POST['product']])) {
                $_SESSION['quantity'][$_POST['product']] = [];
            }
            $_SESSION['quantity'][$_POST['product']] = $_POST['quantity'];

            $connection->close();

            echo json_encode([
                'success' => true,
                'message' => 'Umieszczono wybrany produkt w koszyku',
                'cart' => [
                    'products' => $_SESSION['products'],
                    'quantity' => $_SESSION['quantity']
                ]
            ]);
        }
	}
?>