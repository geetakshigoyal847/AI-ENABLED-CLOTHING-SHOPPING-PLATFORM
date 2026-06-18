<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

include "includes/db.php";


$error = "";



if($_SERVER["REQUEST_METHOD"]=="POST"){


$email = mysqli_real_escape_string($conn,$_POST["email"]);

$password = mysqli_real_escape_string($conn,$_POST["password"]);



$result = mysqli_query($conn,

"SELECT * FROM users 
WHERE email='$email' 
AND password='$password'"

);



if(mysqli_num_rows($result)==1){



$user=mysqli_fetch_assoc($result);



$_SESSION["user_id"]=$user["id"];

$_SESSION["name"]=$user["name"];

$_SESSION["role"]=$user["role"];





if($user["role"]=="admin"){


header("Location: admin/index.php");


}else{


header("Location: products.php");


}


exit();



}
else{


$error="Invalid email or password.";


}



}



?>



<!DOCTYPE html>

<html>


<head>


<title>
StyleNest | Login
</title>



<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="assets/css/style.css">



<style>


body{


background:#f8f7f5;

font-family:Arial,sans-serif;


}



.login-container{


min-height:100vh;

display:flex;

justify-content:center;

align-items:center;


}



.login-box{


width:400px;

background:white;

padding:40px;

border-radius:20px;

box-shadow:0 10px 35px rgba(0,0,0,0.12);

text-align:center;


}



.logo{


font-size:38px;

font-weight:bold;

margin-bottom:10px;


}



.logo span{


color:#b8860b;


}



.subtitle{


color:#777;

margin-bottom:30px;


}



input{


width:100%;

padding:14px;

margin:10px 0;

border:1px solid #ddd;

border-radius:10px;

font-size:15px;


}



button{


width:100%;

padding:14px;

border:none;

border-radius:10px;

background:#111;

color:white;

font-size:16px;

cursor:pointer;

margin-top:15px;


}



button:hover{


opacity:.9;


}



.error{


background:#ffe5e5;

color:#c00;

padding:10px;

border-radius:8px;


}



a{


color:#111;

font-weight:bold;


}


</style>


</head>




<body>




<div class="login-container">



<div class="login-box">



<div class="logo">

Style<span>Nest</span>

</div>


<p class="subtitle">

AI-Powered Fashion for You

</p>



<?php if($error): ?>

<div class="error">

<?= $error ?>

</div>

<?php endif; ?>




<form method="POST">



<input

type="email"

name="email"

placeholder="Email address"

required>




<input

type="password"

name="password"

placeholder="Password"

required>





<button>

Login

</button>



</form>





<p>

Don't have an account?

<a href="signup.php">

Create account

</a>

</p>




</div>



</div>




</body>


</html>