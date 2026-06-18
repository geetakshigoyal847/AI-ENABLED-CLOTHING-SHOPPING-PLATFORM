<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

?>


<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?= SITE_NAME ?> - AI Powered Fashion</title>


<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css?v=100">


</head>


<body>


<header class="header">


<a class="brand" href="<?= BASE_URL ?>index.php">


<div class="hanger">
♧
</div>


<div>


<div class="brand-name">
Style<span>Nest</span>
</div>


<div class="tagline">
AI-Powered Fashion for You
</div>


</div>


</a>





<nav class="nav">


<a href="<?= BASE_URL ?>index.php">
Home
</a>


<a href="<?= BASE_URL ?>products.php?gender=Men">
Men
</a>


<a href="<?= BASE_URL ?>products.php?gender=Women">
Women
</a>


<a href="<?= BASE_URL ?>products.php?gender=Kids">
Kids
</a>


<a href="<?= BASE_URL ?>products.php">
Categories
</a>


<a href="<?= BASE_URL ?>recommendations.php">
AI Picks
</a>



<?php if(isset($_SESSION['role']) && $_SESSION['role']=="admin"): ?>

<a href="<?= BASE_URL ?>admin/index.php">
Admin
</a>

<?php endif; ?>


</nav>






<form class="search" action="<?= BASE_URL ?>products.php" method="get">


<input 
name="q" 
placeholder="Search for products...">


<button>
⌕
</button>


</form>







<div class="user-links">


<?php if(isset($_SESSION['user_id'])): ?>


<span class="hello">

Hi, <?= isset($_SESSION['name']) ? e($_SESSION['name']) : 'User' ?>

</span>

<a href="<?= BASE_URL ?>account/orders.php">
My Orders
</a>
    
<a href="<?= BASE_URL ?>auth/logout.php">
Logout
</a>



<?php else: ?>


<a href="<?= BASE_URL ?>index.php">
Account
</a>



<?php endif; ?>




<a href="<?= BASE_URL ?>wishlist/index.php">

♡ Wishlist

</a>




<a href="<?= BASE_URL ?>cart/index.php">

🛒 Cart

<?php 

if(!empty($_SESSION['cart'])){

echo "(".array_sum($_SESSION['cart']).")";

}

?>

</a>



</div>




</header>



<main class="page">
    