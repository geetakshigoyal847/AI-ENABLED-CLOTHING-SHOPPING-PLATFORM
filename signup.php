<?php

session_start();

if(!isset($_SESSION["user_id"])){

header("Location: index.php");
exit();

}

?>

<!DOCTYPE html>
<html>

<head>

<title>StyleNest Dashboard</title>

<link rel="stylesheet" href="assets/style.css">

</head>


<body class="auth-page">


<div class="auth-card">


<h1>Welcome to StyleNest</h1>

<p>
Hello <?php echo $_SESSION["name"]; ?>
</p>


<p>
You are logged in successfully.
</p>


<a href="auth/logout.php">
Logout
</a>


</div>


</body>

</html>