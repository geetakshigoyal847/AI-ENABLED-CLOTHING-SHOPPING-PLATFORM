<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

include __DIR__ . '/includes/header.php';


$where=[];


if(!empty($_GET['category'])){

$cat=mysqli_real_escape_string($conn,$_GET['category']);

if(in_array($cat,['Men','Women','Kids'])){

$where[]="gender='$cat'";

}else{

$where[]="category='$cat'";

}

}



if(!empty($_GET['gender'])){

$gender=mysqli_real_escape_string($conn,$_GET['gender']);

$where[]="gender='$gender'";

}




if(!empty($_GET['q'])){

$q=mysqli_real_escape_string($conn,$_GET['q']);

$where[]="(name LIKE '%$q%' OR category LIKE '%$q%' OR description LIKE '%$q%')";

}



$sql="SELECT * FROM products";


if($where){

$sql.=" WHERE ".implode(" AND ",$where);

}


$sql.=" ORDER BY id DESC";



$res=mysqli_query($conn,$sql);


if(!$res){

die(mysqli_error($conn));

}

?>



<div class="shop-layout">



<aside class="panel sidebar">


<h3>Categories</h3>


<?php foreach(
[
'Men',
'Women',
'Kids',
'T-Shirts',
'Shirts',
'Hoodies',
'Jackets',
'Jeans',
'Shoes',
'Dresses',
'Bags',
'Accessories'

] as $c): ?>


<label>

<input 
type="radio"
onclick="location.href='<?=BASE_URL?>products.php?category=<?=urlencode($c)?>'">

<?=e($c)?>

</label>


<?php endforeach; ?>


</aside>






<section>


<div class="toolbar">


<div>

<h1>All Products</h1>

<p>Browse and filter clothing collections</p>


</div>


</div>






<div class="grid">



<?php while($p=mysqli_fetch_assoc($res)): ?>



<div class="card">


<a class="wishlist-heart"
href="<?=BASE_URL?>wishlist/add.php?id=<?=$p['id']?>">

♡

</a>




<img src="<?=BASE_URL?>assets/images/<?=e($p['image'])?>">





<div class="card-body">


<h3>

<?=e($p['name'])?>

</h3>




<div class="price">

$<?=number_format($p['price'],2)?>

</div>




<div class="stars">

★★★★★

<span>

(<?=$p['rating']?>)

</span>

</div>




<a class="btn"
href="<?=BASE_URL?>cart/add.php?id=<?=$p['id']?>">

Add to Cart

</a>



</div>


</div>




<?php endwhile; ?>



</div>



</section>





<aside class="panel">


<h3>Your Cart</h3>


<p>

<?php

echo !empty($_SESSION['cart'])

? array_sum($_SESSION['cart'])." item(s) selected."

: "No items added yet.";

?>

</p>



<a class="btn"
href="<?=BASE_URL?>cart/index.php">

View Cart

</a>



<a class="btn secondary"
href="<?=BASE_URL?>cart/checkout.php">

Checkout

</a>



</aside>



</div>



<?php include __DIR__.'/includes/footer.php'; ?>