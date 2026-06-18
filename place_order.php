<?php

session_start();

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';


if(empty($_SESSION['cart'])){

    header("Location: ".BASE_URL."cart/index.php");
    exit;

}


include __DIR__ . '/../includes/header.php';



$total = 0;

?>



<h1>Checkout</h1>


<div class="panel">


<h3>Order Summary</h3>



<?php


foreach($_SESSION['cart'] as $id=>$qty){


$result = mysqli_query(
$conn,
"SELECT * FROM products WHERE id='$id'"
);



$product = mysqli_fetch_assoc($result);



$subtotal = $product['price'] * $qty;


$total += $subtotal;



echo "

<div>

<h4>
{$product['name']}
</h4>


<p>
Quantity: {$qty}
</p>


<p>
Price: $".number_format($subtotal,2)."
</p>


</div>

<hr>

";


}



?>



<h2>

Total: $<?=number_format($total,2)?>

</h2>




<form method="post">


<h3>Payment</h3>


<p>
Payment Method: Cash on Delivery
</p>



<button class="btn">

Place Order

</button>


</form>



</div>





<?php


if($_SERVER['REQUEST_METHOD']=="POST"){



$user_id = $_SESSION['user_id'] ?? 0;



$order_query = "

INSERT INTO orders

(user_id, order_date, total, payment_method, payment_status, status)

VALUES

('$user_id',
NOW(),
'$total',
'Cash on Delivery',
'Pending',
'Pending')

";




if(mysqli_query($conn,$order_query)){



$order_id = mysqli_insert_id($conn);





foreach($_SESSION['cart'] as $id=>$qty){



$product = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT * FROM products WHERE id='$id'"

)

);





mysqli_query($conn,

"

INSERT INTO order_items

(order_id, product_id, quantity, price)

VALUES

('$order_id',
'$id',
'$qty',
'{$product['price']}')

"

);



}




$_SESSION['cart']=[];



echo "

<h2>
✅ Order placed successfully!
</h2>


<p>
Order ID: #$order_id
</p>

";



}

else{


echo mysqli_error($conn);


}



}



include __DIR__ . '/../includes/footer.php';

?>