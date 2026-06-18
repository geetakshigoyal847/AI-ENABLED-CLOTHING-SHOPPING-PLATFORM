<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

include "includes/db.php";


$error = "";
$success = "";



if($_SERVER["REQUEST_METHOD"]=="POST"){



$name = mysqli_real_escape_string($conn,$_POST['name']);

$email = mysqli_real_escape_string($conn,$_POST['email']);

$phone = mysqli_real_escape_string($conn,$_POST['phone']);

$address = mysqli_real_escape_string($conn,$_POST['address']);

$password = mysqli_real_escape_string($conn,$_POST['password']);





$check = mysqli_query($conn,

"SELECT * FROM users WHERE email='$email'"

);



if(mysqli_num_rows($check)>0){


$error="Email already registered.";


}

else{



$query = mysqli_query($conn,


"INSERT INTO users

(name,email,phone,address,password,role)

VALUES

('$name',
'$email',
'$phone',
'$address',
'$password',
'customer')"



);



if($query){


$success="Account created successfully. You can login now.";


}

else{


$error="Registration failed.";


}



}



}



?>





<!DOCTYPE html>

<html>


<head>


<title>
StyleNest | Create Account
</title>


<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="assets/css/style.css">



<style>


body{


background:#f8f7f5;

font-family:Arial,sans-serif;


}



.signup-container{


min-height:100vh;

display:flex;

justify-content:center;

align-items:center;


}



.signup-box{


width:450px;

background:white;

padding:40px;

border-radius:20px;

box-shadow:0 10px 35px rgba(0,0,0,.12);


}



.logo{


text-align:center;

font-size:38px;

font-weight:bold;


}



.logo span{


color:#b8860b;


}



.subtitle{


text-align:center;

color:#777;

margin-bottom:25px;


}



input{


width:100%;

padding:13px;

margin:8px 0;

border:1px solid #ddd;

border-radius:10px;


}



button{


width:100%;

padding:14px;

background:#111;

color:white;

border:none;

border-radius:10px;

font-size:16px;

cursor:pointer;

margin-top:15px;


}



button:hover{


opacity:.9;


}



.message{


padding:10px;

border-radius:8px;

margin-bottom:15px;


}



.error{


background:#ffe5e5;

color:#b00000;


}



.success{


background:#e7ffe7;

color:#006600;


}



.login-link{


text-align:center;

margin-top:20px;


}



</style>


</head>



<body>



<div class="signup-container">


<div class="signup-box">



<div class="logo">

Style<span>Nest</span>

</div>



<p class="subtitle">

Create your fashion account ✨

</p>





<?php if($error): ?>

<div class="message error">

<?= $error ?>

</div>

<?php endif; ?>





<?php if($success): ?>

<div class="message success">

<?= $success ?>

</div>

<?php endif; ?>






<form method="POST">



<input

type="text"

name="name"

placeholder="Full Name"

required>




<input

type="email"

name="email"

placeholder="Email Address"

required>




<input

type="text"

name="phone"

placeholder="Phone Number"

>




<input

type="text"

name="address"

placeholder="Delivery Address"

>




<input

type="password"

name="password"

placeholder="Password"

required>





<button>

Create Account

</button>




</form>





<div class="login-link">


Already have an account?

<a href="index.php">

Login

</a>


</div>



</div>


</div>




</body>


</html>