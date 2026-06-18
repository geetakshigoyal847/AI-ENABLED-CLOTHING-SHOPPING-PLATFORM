<?php

session_start();

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';


if(isset($_GET['id'])){


    $product_id = intval($_GET['id']);


    // check product exists
    $check = mysqli_query(
        $conn,
        "SELECT id FROM products WHERE id='$product_id'"
    );


    if(mysqli_num_rows($check) > 0){


        if(!isset($_SESSION['cart'])){

            $_SESSION['cart'] = [];

        }


        if(isset($_SESSION['cart'][$product_id])){


            $_SESSION['cart'][$product_id]++;


        } else {


            $_SESSION['cart'][$product_id] = 1;


        }


    }


}


header("Location: ".BASE_URL."cart/index.php");

exit;

?>