<?php

include __DIR__ . '/../includes/header.php';


$error = '';



if($_SERVER['REQUEST_METHOD']==='POST'){


$email = mysqli_real_escape_string($conn,$_POST['email'] ?? '');

$password = $_POST['password'] ?? '';



$res = mysqli_query(
$conn,
"SELECT * FROM users WHERE email='$email' LIMIT 1"
);



if($user=mysqli_fetch_assoc($res)){



if($password === $user['password']){


$_SESSION['user_id']=$user['id'];

$_SESSION['name']=$user['name'];

$_SESSION['role']=$user['role'];



if($user['role']==='admin'){


redirect_to('admin/index.php');


}


else{


redirect_to('index.php');


}



}


}



$error="Invalid email or password.";


}


?>





<div class="auth-page">



<div class="auth-card">



<div class="auth-left">


<h1>
Welcome Back 👋
</h1>


<p>
Login to continue your StyleNest fashion journey.
</p>



<div class="fashion-text">

✨ AI Powered Fashion Recommendations

<br>

👗 Trending styles

<br>

🛒 Easy shopping experience

</div>



</div>






<div class="auth-form">


<h2>
Login
</h2>


<?php if($error): ?>

<div class="alert">

<?=e($error)?>

</div>

<?php endif; ?>




<form method="post">



<label>
Email Address
</label>


<input 
type="email"
name="email"
placeholder="Enter your email"
required>





<label>
Password
</label>


<div class="password-box">


<input 
id="password"
type="password"
name="password"
placeholder="Enter password"
required>


<button 
type="button"
onclick="togglePassword()">

👁

</button>


</div>




<button class="btn">

Login

</button>



</form>




<p class="register-text">

Don't have an account?

<a href="<?=BASE_URL?>auth/register.php">

Create account

</a>


</p>


</div>




</div>


</div>




<script>


function togglePassword(){


let pass=document.getElementById("password");


if(pass.type==="password"){

pass.type="text";

}

else{

pass.type="password";

}


}


</script>





<?php include __DIR__ . '/../includes/footer.php'; ?>