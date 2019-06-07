
<?php

session_start();

?>
<?php
if (!isset($_SESSION['zalogowany']) || ($_SESSION['zalogowany'] !== true))
{
    header('Location: index2.php');
    exit();
}
?>
<?php

$dbh = new PDO('mysql:host=localhost;dbname=shop', 'root', '');
$products = [];

foreach($dbh->query('SELECT * from products') as $row) {
    $products[] = $row;
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


<?php
if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>
<nav class="navbar navbar-dark bg-dark justify-content-between">
    <a class="navbar-brand">Panel</a>
    <a href="#" onclick="addNewProduct()">Dodaj</a>
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Nazwa" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Szukaj</button>
    </form>
</nav>



<div id="newproduct" class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin">
                <div class="card-body card_div">
                    <h5 class="card-title text-center">Nowy produkt</h5>
                    <form class="form-signin" action="#" method="post" enctype="multipart/form-data">
                        <img id="close" src="./assets/images/close.png" onclick="div_hide()"/>
                        <div class="form-group">

                            <input type="text" class="form-control" name="product_name" placeholder="Nazwa" required/>
                        </div>
                        <br />
                        <div class="form-label-group">

                            <input type="text" class="form-control" name="product_price" placeholder="Cena" required/>
                        </div>
                        <br />
                        <div class="form-label-group">

                            <input type="text" class="form-control" name="product_category" placeholder="Kategoria" required/>
                        </div>
                        <br />
                        <div class="form-label-group">
                            <input type="text" class="form-control" name="product_brand" placeholder="Marka" required/>
                        </div>
                        <br />
                        <div class="form-label-group">
                            <input type="text" class="form-control" name="product_size" placeholder="Rozmiar" required/>
                        </div>
                        <br />
                        <div class="form-label-group">
                            <input type="file" class="form-control" accept="image/png, image/jpeg" name="photo" placeholder="Zdjęcie" required/>
                        </div>
                        <br/>
                        <div class="form-label-group">
                            <button id="submitBtn" name="submitBtn" type="submit" class="btn  btn-success" >Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="editproduct" class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin">
                <div class="card-body card_div">
                    <h5 class="card-title text-center">Edycja</h5>
                    <form class="form-signin" action="#" method="post" enctype="multipart/form-data">
                        <img id="close" src="./assets/images/close.png" onclick="div_hideedit()"/>
                        <div class="form-group">

                            <input type="text" id="edit_name" class="form-control" name="product_name"  />
                        </div>
                        <br />
                        <div class="form-label-group">

                            <input type="text" id="edit_price" class="form-control" name="product_price"  />
                        </div>
                        <br />
                        <div class="form-label-group">

                            <input type="text" id="edit_category" class="form-control" name="product_category"  />
                        </div>
                        <br />
                        <div class="form-label-group">
                            <input type="text" id="edit_brand" class="form-control" name="product_brand" />
                        </div>
                        <br />
                        <div class="form-label-group">
                            <input type="text" id="edit_size" class="form-control" name="product_size" />
                        </div>
                        <br />
                        <div class="form-label-group">
                            <input type="file" class="form-control" accept="image/png, image/jpeg" name="photo" placeholder="Zdjęcie" required/>
                        </div>
                        <br/>
                        <div class="form-label-group">
                            <button id="submitBtn" name="submitBtn" type="submit" class="btn  btn-success" >Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="list-content text-center" >
    <form name="x" method="post" action="#" >
        <ul class="list-group">

            <?php
            foreach ($products as $product) {
                ?>

                <li class="col-sm-12 col-md-10 list-group-item text-left" style="color:black;list-style-type: none;margin-bottom: 10px">
                    <span  style="margin-right: 10px" name="id"><?php echo $product["id"]?></span>
                    <?php echo '<img  class="img-thumbnail" data-src="' . 'assets/images/' . $product["image"] . '" alt="100%x180" src="' . 'assets/images/' . $product["image"] . '" data-holder-rendered="true" style="height: 100px; width: 100px">'?>
                    <span  style="margin-right: 10px"><?php echo $product["name"]?></span>
                    <span style="margin-right: 10px"><?php echo "Cena ".$product["price"]. " PLN "?></span>
                    <span style="margin-right: 10px"><?php echo "Kategoria ".$product["category"]?></span>
                    <span style="margin-right: 10px"><?php echo "Rozmiar" .$product["size"]?></span>
                    <span >
                        <button type="submit" id="editBtn" name="editBtn" class="editBtn btn btn-success btn-xs" value="<?= $product["id"]?>" >EDIT</button>
                        <button type="submit" name="delBtn" class="delBtn btn btn-danger  btn-xs"  value="<?= $product["id"]?>">DELETE</button>
                    </span>
                </li>

                <?php
            }
            ?>

        </ul>
    </form>
</div>

</div>
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

        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        unlink('assets/images/'. "$temp");

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    header("Refresh:0");
}elseif(isset($_POST['submitBtn'])){
    $name = $_POST["product_name"];
    $brand= $_POST["product_brand"];
    $price= $_POST["product_price"];
    $size= $_POST["product_size"];
    $category= $_POST["product_category"];
    $file_name= $_FILES['photo']['name'];
    $target_dir = "./assets/images/";
    $target_file = $target_dir . $file_name;

    try {
        $conn = new PDO('mysql:host=localhost;dbname=shop', 'root', '');
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO products(name, price,category,brand,size,image) VALUES (?,?,?,?,?,?)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$name,$price, $category,$brand,$size,$file_name]);
        move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);

    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>


<script>

    function addNewProduct() {
        document.getElementById("newproduct").style.display="block";
    }
    function div_hide() {
        document.getElementById("newproduct").style.display="none";
    }

    function editProduct() {
        document.getElementById("editproduct").style.display="block";
    }
    function div_hideedit() {
        document.getElementById("editproduct").style.display="none";
    }
    $(document).ready(function(){
        $(".editBtn").click(function(e){
            let editBtn = $(this).attr("value");
            console.log(editBtn);
            $.ajax({
                type: "POST",
                data: "editBtn="+ editBtn,
                url: "editproduct.php",
                success: function(response) {
                    console.log(response);
                    var temp =JSON.parse(response);
                    $("#edit_name").val(temp["name"]);
                    $("#edit_price").val(temp["price"]);
                    $("#edit_category").val(temp["category"]);
                    $("#edit_brand").val(temp["brand"]);
                    $("#edit_size").val(temp["size"]);
                },error:function(jqXHR,textStatus,errorThrown ){
                    alert('Exception:'+errorThrown );
                }
            });
            editProduct();
            e.preventDefault();
        });


    });

</script>

</body>
</html>
